<div class=" rounded-xl mt-4" x-data="{
     openTable: $persist(true), modal: false, editMode: false,
      ans : @entangle('ans').defer,
      time : {{$quiz->seconds_per_item*$quiz->questions->count()}},
      date_time : {{$date_time}},
      now: new Date().getTime(),
      seconds: 00,
      minutes: 00,
      hours: 00,
      set_time: 00,

      format: function(value){
      if (value<10){
      return '0' + Math.floor(value);
      }else{
      return Math.floor(value);
      }
      }
     }"
     x-init="
     set_time = time*1000;
     counter = setInterval(() => {
     time--
     seconds = format(time % 60);
     minutes = format(time / 60 % 60);
     hours = format(time / 3600 % 24);
     if(time<=0){
     clearInterval(counter);
     }
{{--      now = new Date().getTime()--}}
     }, 1000),
     setTimeout(() => {
     $wire.set('ans', ans);
           $wire.submit()
     }, set_time),

     $wire.on('openModal', (e) => {modal = true})
     $wire.on('openEditModal', (e) => {modal = true, editMode=true})
     $wire.on('closeModal', (e) => {modal = false, editMode=false})
     $wire.on('dataAdded', (e) => {
            modal = false
            editMode = false
            element = document.getElementById(e.dataId)
            console.log(element)
            element.scrollIntoView({behavior: 'smooth'})
            element.classList.add('bg-green-50')
            element.classList.add('dark:bg-gray-500')
            element.classList.add('animate-pulse')
            setTimeout(() => {
            element.classList.remove('bg-green-50')
            element.classList.remove('dark:bg-gray-500')
            element.classList.remove('animate-pulse')
            }, 5000)
            })
@if (session('scrollToComment'))
         const commentToScrollTo = document.getElementById({{session('scrollToComment')}})
            commentToScrollTo.scrollIntoView({ behavior: 'smooth'})
            commentToScrollTo.classList.add('bg-green-50')
            setTimeout(() => {
                commentToScrollTo.classList.remove('bg-green-50')
            }, 5000)
        @endif"
     @open-delete-modal.window="
     model = event.detail.model
     eventName = event.detail.eventName
Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit(eventName, model )
                }
            })
"
>
    @json($ans)
    <div class="">
        <div class="mx-auto text-center">
            <button class="text-center mx-auto text-blue-500" wire:click.prevent="$refresh">asdf</button>
            <button class="text-center mx-auto text-blue-500" @click="$wire.set('ans', ans), $wire.submit()">submit</button>
            <button class="text-center mx-auto text-blue-500" x-text="hours">fffff</button>
            <button class="text-center mx-auto text-blue-500" x-text="minutes">fffff</button>
            <button class="text-center mx-auto text-blue-500" x-text="seconds">fffff</button>
        </div>
        <h1 x-html="ans"></h1>
        <div class="mx-auto md:w-1/2">
            @foreach($items as $i => $item)
                <div class="flex gap-2 justify-start my-2" wire:key="{{$item->id}}-asdf">
                    <span>{{$i+1}}</span>
                    <p class="font-semibold text-lg text-green-400">{{$item->name}}?</p>

                </div>
            <div class="grid grid-2 md:grid-4 justify-between">
                @if($item->trueAnswer->ans_id==null)
                    <span class="text-red-400">you din not answer</span>
                @endif
            @foreach($item->options as $j => $option)
                <label for="id-{{$option->id}}" wire:key="{{$option->id}}-fdsa">
                    <input x-model="ans[{{$i}}]"  value="{{$item->id.'-'.$option->id}}" id="id-{{$option->id}}" name="id-{{$item->id}}" type="radio">
                    <span class="{{$item->answer == $option->id?'text-blue-500':''}} {{$item->trueAnswer->ans_id == $option->id?'text-xs text-red-400':''}}">{{$option->name}} </span>
                </label>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
    <div x-cloak x-show="modal">
        <div class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
        <div  class="inset-0 py-4 rounded-2xl transition duration-150 ease-in-out z-50 absolute" id="modal">
            <div @click.outside="modal= false, editMode = false" class="container mx-auto w-11/12 md:w-2/3 max-w-lg ">
                <form @submit.prevent="editMode? $wire.editData(): $wire.saveData()" class="relative py-3 px-5 md:px-10 bg-white dark:bg-darkSidebar shadow-md rounded border border-gray-400 dark:border-gray-600 capitalize">
                    <h1 x-cloak x-show="!editMode" class="text-gray-800 dark:text-gray-200 font-lg font-bold tracking-normal text-center leading-tight mb-4">@lang('add new data')</h1>
                    <h1 x-cloak x-show="editMode" class="text-gray-800 dark:text-gray-200 font-lg font-bold tracking-normal text-center leading-tight mb-4">@lang('edit this data')</h1>

                    <label for="name" class="text-gray-800 dark:text-gray-200 text-sm font-bold leading-tight tracking-normal">@lang('name')</label>
                    <input wire:model.lazy="name" class="mb-1 mt-2 text-gray-600 dark:text-gray-300 focus:outline-none focus:border focus:border-indigo-700 font-normal dark:bg-darkBg w-full h-10 flex items-center pl-3 text-sm border-gray-300 dark:border-gray-600 rounded border"/>
                    @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    <div class="flex items-center justify-between w-full mt-4">
                        <button type="button" @click="modal= false, editMode = false" class="bg-red-600 focus:ring-gray-400 transition duration-150 text-white ease-in-out hover:bg-red-300 rounded px-8 py-2 text-sm">Cancel</button>
                        <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

