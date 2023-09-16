<?php

namespace App\Http\Services\Supervisor;

use AllowDynamicProperties;
use Exception;
use fXmlRpc\Transport\HttpAdapterTransport;
use GuzzleHttp\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Illuminate\Support\Facades\File;
use Supervisor\Configuration\Loader\IniFileLoader;
use Supervisor\Configuration\Section\Program;
use Supervisor\Configuration\Writer\IniFileWriter;
use Supervisor\Supervisor;

class SupervisorService
{
    private const PREFIX = 'program:';
    private const NAME = '%(program_name)s_%(process_num)02d';
    private const AUTO_START = true;
    private const AUTO_RESTART = true;
    private const USER = 'www-data';
    private const START_RETRIES = 100;
    private Supervisor $supervisor;


    public function __construct()
    {
        $guzzleClient = new Client(
            [
                'auth' => [
                    config('supervisor.user'),
                    config('supervisor.password'),
                ],
            ]
        );
        $client = new \fXmlRpc\Client(
            config('supervisor.clientUrl'),
            new HttpAdapterTransport(
                new GuzzleMessageFactory(),
                $guzzleClient
            )
        );

        $this->supervisor = new Supervisor($client);
    }

    public function stopProcesses(string $processName): bool
    {
        try {
            $this->supervisor->stopProcessGroup($processName);
            return true;
        } catch (Exception $exception) {
            var_dump($exception->getMessage());

            return false;
        }
    }

    public function startProcesses(string $processName): bool
    {
        try {
            $this->supervisor->startProcessGroup($processName);
            return true;
        } catch (Exception $exception) {
            var_dump($exception->getMessage());

            return false;
        }
    }

    public function getAllProcesses(): string|array
    {
        try {
            return $this->supervisor->getAllProcessInfo();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function addProcesses(SupervisorDTO $dto): void
    {
        try {
            $filePath = config('supervisor.configPath');
            $config = (new IniFileLoader($filePath))->load();
            if ($config->hasSection(self::PREFIX . $dto->getName()) === true) {
                return;
            }
            $section = new Program(
                $dto->getName(), [
                    'command' => $dto->getCommand(),
                    'process_name' => self::NAME,
                    'autostart' => self::AUTO_START,
                    'autorestart' => self::AUTO_RESTART,
                    'user' => self::USER,
                    'numprocs' => $dto->getNumber(),
                    'startretries' => self::START_RETRIES,
                ]
            );
            $config->addSection($section);
            (new IniFileWriter($filePath))->write($config);
            $this->supervisor->reloadConfig();
        } catch (Exception $exception) {
            var_dump($exception->getMessage());
        }
    }

    public function delete(string $processName): void
    {
        try {
            $filePath = config('supervisor.configPath');
            $config = (new IniFileLoader($filePath))->load();
            if ($config->hasSection(self::PREFIX . $processName) === false) {
                return;
            }
            $config->removeSection(self::PREFIX . $processName);
            (new IniFileWriter($filePath))->write($config);
            $this->supervisor->reloadConfig();
            File::put($filePath, ' ');
        } catch (Exception $exception) {
        }
    }

    public function updateProcesses(SupervisorDTO $dto): void
    {
        try {
            $filePath = config('supervisor.configPath');
            $config = (new IniFileLoader($filePath))->load();
            if ($config->hasSection(self::PREFIX . $dto->getName()) === false) {
                return;
            }
            $config->removeSection(self::PREFIX . $dto->getName());
            $section = new Program(
                $dto->getName(), [
                    'command' => $dto->getCommand(),
                    'process_name' => self::NAME,
                    'autostart' => self::AUTO_START,
                    'autorestart' => self::AUTO_RESTART,
                    'user' => self::USER,
                    'numprocs' => $dto->getNumber(),
                    'startretries' => self::START_RETRIES,
                ]
            );
            $config->addSection($section);
            (new IniFileWriter($filePath))->write($config);
            $this->supervisor->reloadConfig();

        } catch (Exception $exception) {
        }
    }

}

