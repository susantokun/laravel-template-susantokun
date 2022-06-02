@props(['icon', 'icon_class', 'value', 'text', 'percent_status', 'percent_bg', 'percent_title', 'percent_value', 'percent_icon'])

<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
    <div class="zoom-in card_box">
        <div class="flex items-center justify-between p-5 box">
            <div class="flex flex-col w-2/3">
                <div class="text-base text-slate-500">{{ $text ?? 'Item' }}</div>
                <div class="w-full mr-2 text-2xl font-medium leading-8 truncate 2xl:text-3xl">{{ $value ?? 0 }}</div>
            </div>
            <div class="flex flex-col items-end justify-end w-auto">
                @if ($percent_status)
                <div
                    class="card_box__indicator tooltip {{ $percent_bg ?? 'bg-pending' }}"
                    title="{{
                        $percent_title
                        }}"
                >
                    {{ $percent_value ?? '-' }} <i
                        data-feather={{
                        $percent_icon
                        ?? 'minus'
                        }}
                        class="w-4 h-4 ml-0.5"
                    ></i>
                </div>
                @endif
                <div class="mt-2">
                    <i
                        data-feather="{{$icon}}"
                        class="card_box__icon {{ $icon_class }}"
                    ></i>
                </div>
            </div>
        </div>
    </div>
</div>
