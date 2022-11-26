<div>
    <div class="mt-6">
        <table class="w-full whitespace-no-wrap mt-4 mb-4 shadow-2xl" wire:loading.class.delay="opacity-50">
           
            <thead>
                @if ($semester1_result->count())
                <tr> <td>semester 1 Result</td></tr>
                <tr class="bg-secondary text-gray-100 font-bold">
                    <td class="px-3 py-2 capitalize">Subjects</td>
                    <td class="px-3 py-2 capitalize">Marks</td>
                    <td class="px-3 py-2 capitalize">Remark</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-400">

                @foreach($semester1_result as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
                    <td class="px-3 py-2 capitalize">{{ $result->subjects?->name }}</td>
                    <td class="px-3 py-2 capitalize">{{ $result->marks }}</td>
                    @switch($result->marks)
                    @case($result->marks>=80)
                    <td class="px-3 py-2 capitalize">Excellence</td>
                        @break

                        @case($result->marks>=70 && $result->marks<80 )
                        <td class="px-3 py-2 capitalize">Very Good</td>
                        @break

                        @case($result->marks>=60 && $result->marks<70 )
                        <td class="px-3 py-2 capitalize">Good</td>
                        @break
                
                        @case($result->marks>=50 && $result->marks<60 )
                        <td class="px-3 py-2 capitalize">Credit</td>
                        @break

                        @case($result->marks>=30 && $result->marks<50 )
                        <td class="px-3 py-2 capitalize">Average</td>
                        @break

                        @case($result->marks<30 )
                        <td class="px-3 py-2 capitalize">Fail</td>
                        @break

                    @default                               
                @endswitch
                </tr>
                @endforeach
                <td>Total Marks:{{ $semester1_result->count()*100 }}  Acquired: {{ $semester1_result->sum('marks') }}</td>
            </tbody>
        </table>
        @endif
        @if (count($semester2_result))
        <table class="w-full whitespace-no-wrap mt-8 shadow-2xl" wire:loading.class.delay="opacity-50">
            <thead>
                <tr> <td>semester 2 Result</td></tr>
                <tr class="bg-secondary text-gray-100 font-bold">
                    <td class="px-3 py-2 capitalize">Subjects</td>
                    <td class="px-3 py-2 capitalize">Marks</td>
                    <td class="px-3 py-2 capitalize">Remark</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-400">
                @foreach($semester2_result as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
                    <td class="px-3 py-2 capitalize">{{ $result->subjects?->name }}</td>
                    <td class="px-3 py-2 capitalize">{{ $result->marks }}</td>
                    @switch($result->marks)
                        @case($result->marks>=80)
                        <td class="px-3 py-2 capitalize">Excellence</td>
                            @break

                            @case($result->marks>=70 && $result->marks<80 )
                            <td class="px-3 py-2 capitalize">Very Good</td>
                            @break

                            @case($result->marks>=60 && $result->marks<70 )
                            <td class="px-3 py-2 capitalize">Good</td>
                            @break
                    
                            @case($result->marks>=50 && $result->marks<60 )
                            <td class="px-3 py-2 capitalize">Credit</td>
                            @break

                            @case($result->marks>=30 && $result->marks<50 )
                            <td class="px-3 py-2 capitalize">Average</td>
                            @break

                            @case($result->marks<30 )
                            <td class="px-3 py-2 capitalize">Fail</td>
                            @break

                        @default
                            
                    @endswitch
                </tr>
                @endforeach
                <td>Total Marks:{{ $semester2_result->count()*100 }}  Acquired: {{ $semester2_result->sum('marks') }}</td>
            </tbody>
        </table>
        @endif
    </div>
</div>
