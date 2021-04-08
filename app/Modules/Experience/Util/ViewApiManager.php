<?php

namespace App\Modules\Experience\Util;

use App\Modules\Agenda\Models\AgendaItem;
use App\Modules\Experience\Exceptions\TypeNotFoundException;
use App\User;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ViewApiManager implements ApiInterface
{
    /*
     * To return new views from the API add in a 'type' in Experience/Config/views.php
     *
     * 'Types' can simply return a view:
     * e.g. 'agenda' => 'experience::api.agenda.index'
     *
     * Or you can return a view and pass it a users segment relation:
     * e.g. 'breakout-b1' => [
     *      'view' => 'experience::api.breakouts.b1.index'
     *      'user-segment-relation' => [
     *          'breakout'
     *      ],
     *  ]
     */
    public $types;
    private $user;
    private $type;
    private $view;

    public function __construct(User $user, ?string $type)
    {
        $this->types = config('views', 'experience');
        $this->user = $user;
        $this->type = $type;
        $this->view = $this->types[$this->type] ?? null;
    }

    public function get(): string
    {
        if ($this->type === null) {
            return $this->getAllData();
        }

        if ($this->view === null) {
            throw new TypeNotFoundException($this->types);
        }

        return $this->getDataForUser();
    }

    public function getAllData(): string
    {
        return collect($this->types)->mapWithKeys(static function ($view, $type) {

            if (is_array($view)) {
                return [$type => view($view['view'])->render()];
            }

            return [$type => view($view)->render()];
        });
    }

    public function getDataForUser(): string
    {
        if($this->typeIsArray()) {
            return view($this->view['view'])->render();
        }

        return view($this->view)->render();
    }

    public function getUserSegmentRelation(): Collection
    {
        return $this->user->segments()->first()->{$this->view['user-segment-relation']};
    }

    public function typeIsArray(): bool
    {
        return is_array($this->types);
    }
}
