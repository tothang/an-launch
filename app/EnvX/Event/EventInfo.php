<?php

namespace App\EnvX\Event;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class EventInfo
{
    private const METHOD_DATES = 'dates';
    private const METHOD_DATE = 'date';
    private const METHOD_TIME = 'time';

    private $dynamicallyCallable = [
        self::METHOD_DATES,
        self::METHOD_DATE,
        self::METHOD_TIME
    ];

    private $cached = [];

    private $data;

    public function __construct(array $config)
    {
        $this->data = $config;
    }

    public static function consume(array $config): self
    {
        return new static($config);
    }

    public function emailSubjectPrefix(): string
    {
        return $this->client() . ' - ' . $this->title();
    }

    public function dates(): EventDatesHandler
    {
        return (new EventDatesHandler($this->start(), $this->end()));
    }

    public function date(): EventDateFormatter
    {
        return (new EventDateFormatter($this->start(), $this->end()));
    }

    public function time(): EventTimeFormatter
    {
        return (new EventTimeFormatter($this->start(), $this->end()));
    }

    public function __call($name, $arguments)
    {
        // Prep arguments
        $key = Str::snake($name, '-');

        if ($arguments) {
            $key .= ".{$arguments[0]}";
        }

        // Retrieve previously computed calls
        if (Arr::has($this->cached, $key)) {
            return Arr::get($this->cached, $key);
        }

        // Action dynamic calls
        if (Str::contains($name, $this->dynamicallyCallable)) {
            $method = self::METHOD_DATE;

            if (Str::contains($name, self::METHOD_DATES)) {
                $method = self::METHOD_DATES;
            }

            if (Str::contains($name, self::METHOD_TIME)) {
                $method = self::METHOD_TIME;
            }

            $distant = Str::camel(Str::after($name, $method));
            $cacheKey = Str::snake($key, '-');

            Arr::set($this->cached, $cacheKey, $this->$method()->$distant());

            return Arr::get($this->cached, $cacheKey);
        }

        // Action method-driven config calls
        if (Arr::has($this->data, $key)) {
            $cacheKey = Str::snake($key, '-');

            Arr::set($this->cached, $cacheKey, Arr::get($this->data, $key));

            return Arr::get($this->cached, $cacheKey);
        }
    }
}
