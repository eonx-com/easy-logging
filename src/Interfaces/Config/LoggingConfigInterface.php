<?php
declare(strict_types=1);

namespace EonX\EasyLogging\Interfaces\Config;

use EonX\EasyUtils\Interfaces\HasPriorityInterface;

interface LoggingConfigInterface extends HasPriorityInterface
{
    /**
     * @param string[]|null $channels
     */
    public function channels(?array $channels = null): self;

    /**
     * @param string[]|null $exceptChannels
     */
    public function exceptChannels(?array $exceptChannels = null): self;

    /**
     * @return string[]|null
     */
    public function getChannels(): ?array;

    /**
     * @return string[]|null
     */
    public function getExceptChannels(): ?array;

    public function priority(?int $priority = null): self;
}
