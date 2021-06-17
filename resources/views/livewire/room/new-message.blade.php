<form wire:submit.prevent="sendNewMessage" class="flex items-start space-x-3">

    <div class="flex flex-col w-full">
        <textarea wire:model="message" class="rounded-md p-2 shadow-sm border-gray-300 w-full" placeholder="Your Message" name="message" rows="2" widht="100%"></textarea>
        @error('message') <p class="text-red-600 font-semibold">{{$message}}</p>  @enderror
    </div>


    <button class="bg-blue-500 text-white rounded p-2 px-4">send</button>
</form>
