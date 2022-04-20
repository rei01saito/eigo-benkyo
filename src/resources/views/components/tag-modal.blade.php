<button class="mr-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-xs px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="authentication-modal">
  タグを編集する
</button>
  
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="/mypage/tag/store" method="post">
                @csrf
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">タグを編集する</h3>
                <div class="tag">
                
                    @if (!$tags->isEmpty())
                        @foreach ($tags as $tag)
                            <div class="flex items-center">
                                <input type="text" name="tag[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="タグ名" required="" value="{{ $tag['tags_name'] }}">
                                <div class="px-2 flex">
                                    <i class="fa-solid fa-plus active:bg-blue-100 tag-plus mr-2"></i>
                                    <i class="fa-solid fa-minus active:bg-blue-100 tag-minus"></i>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex items-center">
                            <input type="text" name="tag[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="タグ名" required="">
                            <div class="px-2 flex">
                                <i class="fa-solid fa-plus active:bg-blue-100 tag-plus mr-2"></i>
                                <i class="fa-solid fa-minus active:bg-blue-100 tag-minus"></i>
                            </div>
                        </div>
                    @endif

                </div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">追加</button>
            </form>
        </div>
    </div>
</div>

<div class="flex items-center hidden hidden-tag">
  <input type="text" name="tag[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="タグ名" required="">
  <div class="px-2 flex">
    <i class="fa-solid fa-plus active:bg-blue-100 tag-plus mr-2"></i>
    <i class="fa-solid fa-minus active:bg-blue-100 tag-minus"></i>
  </div>
</div>
