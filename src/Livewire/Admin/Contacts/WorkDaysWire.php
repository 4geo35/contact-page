<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Traits\AuthContactTrait;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class WorkDaysWire extends Component
{
    use AuthContactTrait;

    public ContactInterface $contact;
    public array $workTimeData;

    public function mount(): void
    {
        $this->workTimeData = $this->contact->work_times;
    }
    public function render(): View
    {
        return view('ctp::livewire.admin.contacts.work-days-wire');
    }

    public function copyWork(bool $all): void
    {
        $this->copyByKey($all, "workTime");
    }

    public function copyDiner(bool $all): void
    {
        $this->copyByKey($all, "dinerTime");
    }

    public function saveDays(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("work-days-", "update", $this->contact);
        if (! $check) return;

        try {
            $this->contact->work_time = $this->workTimeData;
            $this->contact->save();
            session()->flash("work-days-success", __("Work time successfully updated"));
        } catch (\Exception $ex) {
            session()->flash("work-days-error", __("Error while update work time"));
        }
    }

    protected function copyByKey(bool $all, string $key): void
    {
        $value = $this->workTimeData[0][$key];
        foreach ($this->workTimeData as $index => $item) {
            if (! $all && $index < 5 || $all) {
                $this->workTimeData[$index][$key] = $value;
            }
        }
    }
}
