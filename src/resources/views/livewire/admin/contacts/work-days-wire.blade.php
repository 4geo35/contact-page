<div class="space-y-indent-half">
    <button type="button" class="btn btn-outline-primary" wire:click="saveDays" wire:attribute.loading="disabled">
        {{ __("Save work time") }}
    </button>

    <x-tt::notifications.error prefix="work-days-" />
    <x-tt::notifications.success prefix="work-days-" />

    <div class="block w-full overflow-x-auto beautify-scrollbar">
        <table class="w-full">
            <thead>
            <tr>
                <th class="font-semibold p-indent-half text-left">#</th>
                <th class="font-semibold p-indent-half text-left">Рабочее время</th>
                <th class="font-semibold p-indent-half text-left">Обед</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="font-semibold p-indent-half">Копирование</td>
                <td class="p-indent-half">
                    <div class="space-x-indent-half flex flex-nowrap items-center">
                        <button type="button" class="underline text-primary hover:text-primary"
                                wire:click="copyWork(false)">
                            Рабочие
                        </button>
                        <button type="button" class="underline text-primary hover:text-primary"
                                wire:click="copyWork(true)">
                            Все
                        </button>
                    </div>
                </td>
                <td class="p-indent-half">
                    <div class="space-x-indent-half flex flex-nowrap items-center">
                        <button type="button" class="underline text-primary hover:text-primary"
                                wire:click="copyDiner(false)">
                            Рабочие
                        </button>
                        <button type="button" class="underline text-primary hover:text-primary"
                                wire:click="copyDiner(true)">
                            Все
                        </button>
                    </div>
                </td>
            </tr>
            @foreach($workTimeData as $key => $item)
                <tr>
                    <td class="font-semibold p-indent-half">{{ $item["name"] }}</td>
                    <td class="p-indent-half">
                        <input type="text" class="form-control" aria-label=""
                               wire:model="workTimeData.{{ $key }}.workTime">
                    </td>
                    <td class="p-indent-half">
                        <input type="text" class="form-control" aria-label=""
                               wire:model="workTimeData.{{ $key }}.dinerTime">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
