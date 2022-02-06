@section('title', __('Message a'))
{{--@section('description', __('find Imam Hujur Mosque Madrasa'))--}}
<div class="flex flex-col  md:flex-row md:space-x-6" x-data="{ sender: null, user: '{{auth()->user()->name}}',
     whisper() {
           Echo.join(`demo`)
    .whisper('typing', {
        name: this.user
    });
      }
}"
     x-init="$wire.on('dataAdded', (e) => {
     Echo.join(`demo`)
    .whisper('sent', {
        dataId: e.dataId
    });
     })
            Echo.join('demo').listenForWhisper('typing', (e) => {
                sender = e.name,
                setTimeout(() => {
                sender = null
            }, 5000)
    }).listenForWhisper('sent', (e) => {
              $wire.viewMessage(e.dataId);
              const el = document.getElementById('messagess');
            el.scrollTop = el.scrollHeight
            console.log(el)
    });
            ">
    {{--    @if(auth()->id()==1)--}}
    <div class="px-4 py-4 mx-auto border shadow-md bg-white w-full mb-3">
        <div class="border-t border-b divide-y ">
            @foreach ($conversations as $conversation)
                @if(auth()->id() ==$conversation->sender_id)
                    <div class="flex my-1 items-center px-2 {{ $conversation->id === $selectedConversation->id ? 'py-2 bg-blue-300 ' : '' }}">
                        <a wire:click.prevent="viewMessage({{ $conversation->id }})">
                            <img class="rounded-full w-10 h-10" src="https://www.gravatar.com/avatar/{{md5($conversation->receiver->email)}}?d=mp"/>
                        </a>
                        <div class="pl-2">
                            <div class="font-semibold">
                                <a class="hover:underline" wire:click.prevent="viewMessage({{ $conversation->id }})">{{ $conversation->receiver->name }}</a>
                            </div>
                            <div class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit(@$conversation->messages->last()->body, 25) }}</div>
                        </div>
{{--                        @if($conversation->messages->last()->user_id!=auth()->id())--}}
{{--                            <span class="mx-auto text-red-700">{{$conversation->messages()->whereStatus(0)->count()>0?$conversation->messages()->whereStatus(0)->count():''}}</span>--}}
{{--                        @endif--}}
                        <div class="text-gray-600 ml-auto">
                            @if(Cache::has('is_online' . $conversation->receiver->id))
                                <div class="text-xs text-blue-500">Online</div>
                            @else
                                <span class="fa fa-circle chat-offline"></span>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($conversation->receiver->last_seen)->diffForHumans() }}</span>
                            @endif
                            @if($conversation->messages->last()->user_id==auth()->id())
                                <div class="text-right justify-end">
                                    @if($conversation->messages->last()->status==0)
                                        <div class="ml-auto text-xs text-gray-400">sent</div>
                                    @else
                                        <div class="flex justify-end text-right">
                                            @if(auth()->id() !=$conversation->receiver_id)

                                                <img class="rounded-full w-4 h-4" src="https://www.gravatar.com/avatar/{{md5($conversation->receiver->email)}}?d=mp" />

                                            @else
                                                <img class="rounded-full w-4 h-4" src="https://www.gravatar.com/avatar/{{md5($conversation->sender->email)}}?d=mp" />
                                            @endif
                                        </div>
                                    @endif
                                </div>

                            @endif
                        </div>
                    </div>
                @else
                    <div class="flex my-1 items-center px-2 {{ $conversation->id === $selectedConversation->id ? 'py-2 bg-blue-300 ' : '' }}">
                        <a wire:click.prevent="viewMessage({{ $conversation->id }})">
                            <img class="rounded-full w-10 h-10" src="https://www.gravatar.com/avatar/{{md5($conversation->sender->email)}}?d=mp"/>
                        </a>
                        <a href="">
                            <div class="pl-2">
                                <div class="font-semibold">
                                    <a class="hover:underline" wire:click.prevent="viewMessage({{ $conversation->id }})">{{ $conversation->sender->name }}</a>
                                </div>
                                <div class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit(@$conversation->messages->last()->body, 25) }}</div>
                            </div>
{{--                            @if($conversation->messages->last()->user_id!=auth()->id())--}}
{{--                                <span class="mx-auto text-red-700">{{$conversation->messages()->whereStatus(0)->count()>0?$conversation->messages()->whereStatus(0)->count():''}}</span>--}}
{{--                            @endif--}}
                            <div class="text-gray-600 ml-auto">
                                @if(Cache::has('is_online' . $conversation->sender->id))
                                    <div class="text-xs text-blue-500">Online</div>
                                @else
                                    <span class="fa fa-circle chat-offline"></span>
                                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($conversation->sender->last_seen)->diffForHumans() }}</span>
                                @endif
{{--                                @if($conversation->messages->last()->user_id==auth()->id())--}}
{{--                                    <div class="text-right justify-end">--}}
{{--                                        @if($conversation->messages->last()->status==0)--}}
{{--                                            <div class="ml-auto text-xs text-gray-400">sent</div>--}}
{{--                                        @else--}}
{{--                                            <div class="flex justify-end text-right">--}}
{{--                                                @if(auth()->id() !=$conversation->receiver_id)--}}

{{--                                                    <img class="rounded-full w-4 h-4" src="https://www.gravatar.com/avatar/{{md5($conversation->receiver->email)}}?d=mp" />--}}

{{--                                                @else--}}
{{--                                                    <img class="rounded-full w-4 h-4" src="https://www.gravatar.com/avatar/{{md5($conversation->sender->email)}}?d=mp" />--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}

{{--                                @endif--}}
                            </div>

                        </a>
                    </div>
                @endif

            @endforeach
        </div>
    </div>
    {{--    @endif--}}
    <div class="w-full max-h-xl h-screen flex flex-col border shadow-md bg-white">
        <div class="flex items-center justify-between border-b p-2" >
            <!-- user info -->
            @if(auth()->id() !=$selectedConversation->receiver_id)

                <div class="flex items-center">
                    <img class="rounded-full w-10 h-10"
                         src="https://www.gravatar.com/avatar/{{md5($selectedConversation->receiver->email)}}?d=mp" />
                    <div class="pl-2">
                        <div class="font-semibold">
                            <a class="hover:underline" href="#">{{ $selectedConversation->receiver->name }}</a>
                        </div>
                        @if(Cache::has('is_online' . $selectedConversation->receiver->id))
                            <div class="text-xs text-blue-500">Online</div>
                        @else
                            <span class="fa fa-circle chat-offline"></span>
                            <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($conversation->receiver->last_seen)->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>

            @else
                <div class="flex items-center">
                    <img class="rounded-full w-10 h-10"
                         src="https://www.gravatar.com/avatar/{{md5($selectedConversation->sender->email)}}?d=mp" />
                    <div class="pl-2">
                        <div class="font-semibold">
                            <a class="hover:underline" href="#">{{ $selectedConversation->sender->name }}</a>
                        </div>
                        @if(Cache::has('is_online' . $selectedConversation->sender->id))
                            <div class="text-xs text-blue-500">Online</div>
                        @else
                            <span class="fa fa-circle chat-offline"></span>
                            <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($conversation->sender->last_seen)->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Component Start -->
        <div class="flex flex-col flex-grow w-full max-w-xl bg-white shadow-xl rounded-lg">
            <div class="flex flex-col flex-grow h-0 p-4 overflow-y-auto overflow-x-hidden" id="messagess"
{{--                 wire:poll.5555ms--}}
            >
                @foreach ($selectedConversation->messages as $message)
                    @if($message->user_id != auth()->id())
                        <div class="flex w-10/12 mt-2 space-x-3 max-w-xs">
                            <img class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300" src="https://www.gravatar.com/avatar/{{md5($selectedConversation->receiver->email)}}?d=mp" />
                            <div>
                                <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                                    <p class="text-sm">{{ $message->body }}</p>
                                </div>
                                <img class="" src="{{$message->getFirstMediaUrl('message')}}" />
                                <span class="text-xs text-gray-500 leading-none">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @else
                        <div class="flex w-10/12 mt-2 space-x-3 max-w-xs ml-auto justify-end">
                            <div class="w-11/12">
                                <div class="bg-blue-600 text-white p-3 rounded-l-lg rounded-br-lg">
                                    <p class="text-sm">{{ $message->body }}</p>
                                </div>
                                <img class="" src="{{$message->getFirstMediaUrl('message')}}" />
                                <span class="text-xs text-gray-500 leading-none">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            <img class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300" src="https://www.gravatar.com/avatar/{{md5($selectedConversation->sender->email)}}?d=mp" />
                        </div>
                    @endif
                @endforeach
                <div x-show="sender" class="flex justify-start text-xs gap-1">
                    <span  x-text="sender" class="pl-2 text-purple-600"></span>
                    <span>is typing</span>
                </div>
{{--                @if($selectedConversation->messages->last()->user_id==auth()->id())--}}
{{--                    <div class="text-right justify-end">--}}
{{--                        @if($selectedConversation->messages->last()->status==0)--}}
{{--                            <div class="ml-auto text-xs text-gray-400">sent</div>--}}
{{--                        @else--}}
{{--                            <div class="flex justify-end text-right">--}}
{{--                                @if(auth()->id() !=$selectedConversation->receiver_id)--}}

{{--                                    <img class="rounded-full w-4 h-4" src="https://www.gravatar.com/avatar/{{md5($selectedConversation->receiver->email)}}?d=mp" />--}}

{{--                                @else--}}
{{--                                    <img class="rounded-full w-4 h-4" src="https://www.gravatar.com/avatar/{{md5($selectedConversation->sender->email)}}?d=mp" />--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                @endif--}}
            </div>
            <form action="" wire:submit.prevent="addMessage">
                <div class="flex items-center border-t p-2">
                    <label class="block mt-3">
                        <div class="list-inline flex justify-between"  x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label class="cursor-pointer flex justify-content-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                                <input type="file" class="hidden" wire:model.lazy="image">
                            </label>
                            <div class="col-md-4 list-inline-item" x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </label>
                    @error('image')<span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                    <div class="w-full mx-2 @error('body') is-invalid @enderror">
                        <input hidden type="file" id="file">
                        <input @keyup="whisper()" wire:model.lazy="body" class="w-full rounded-full border border-gray-200" type="text" value="" placeholder="Type your message…" autofocus />
                    </div>
                    <div>
                        <button class="inline-flex hover:bg-indigo-50 rounded-full p-2" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <span class="px-12">@error('body')<span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror</span>
            </form>
        </div>

    </div>

</div>

@push('js')
    <script>
        const el = document.getElementById('messagess');
        el.scrollTop = el.scrollHeight
    </script>

    <script>
        document.addEventListener('livewire:load', function () {
            const el = document.getElementById('messagess');
            el.scrollTop = el.scrollHeight
        });
    </script>

@endpush
