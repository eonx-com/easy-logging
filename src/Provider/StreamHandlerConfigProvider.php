<?php
declare(strict_types=1);

namespace EonX\EasyLogging\Provider;

use EonX\EasyLogging\Config\HandlerConfig;
use InvalidArgumentException;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

final readonly class StreamHandlerConfigProvider implements HandlerConfigProviderInterface
{
    private Level $level;

    /**
     * @var resource|string
     */
    private mixed $stream;

    /**
     * @param resource|string|null $stream
     * @param string[]|null $channels
     * @param string[]|null $exceptChannels
     */
    public function __construct(
        mixed $stream = null,
        ?Level $level = null,
        private ?array $channels = null,
        private ?array $exceptChannels = null,
        private ?int $priority = null,
    ) {
        if ($stream !== null && \is_string($stream) === false && \is_resource($stream) === false) {
            throw new InvalidArgumentException(\sprintf(
                'Stream must be "null", "string" or "resource", "%s" given',
                \gettype($stream)
            ));
        }

        $this->stream = $stream ?? 'php://stdout';
        $this->level = $level ?? Level::Debug;
    }

    /**
     * @return iterable<\EonX\EasyLogging\Config\HandlerConfigInterface>
     *
     * @throws \Exception
     */
    public function handlers(): iterable
    {
        $handlerConfig = HandlerConfig::create(new StreamHandler($this->stream, $this->level));
        $handlerConfig
            ->channels($this->channels)
            ->exceptChannels($this->exceptChannels ?? ['event'])
            ->priority($this->priority);

        yield $handlerConfig;
    }
}
