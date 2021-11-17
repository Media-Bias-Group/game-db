<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="px-6 py-8">
        <main class="mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Enter new sentence!</h1>

            <form method="POST" action="/manual" class="mt-10">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="sentence"
                    >
                        Sentence
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="sentence"
                           id="sentence"
                           required
                    >
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="link"
                    >
                        Link
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="url"
                           name="link"
                           id="link"
                           
                    >
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="outlet"
                    >
                        outlet
                    </label>   
  <select name="outlet" id="outlet"class="form-select block w-full mt-1">
      <option>ABC News</option>
      <option>alternet</option>
      <option>breitbart</option>
      <option>CNN</option>
      <option>federalist</option>
       <option>fox-news</option>
       <option>huffpost</option>
    <option>msnbc</option>
    <option>reuters</option>
    <option>usa-today</option>
  </select>
                    
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="topic"
                    >
                        outlet
                    </label>   
  <select name="topic" id="topic"class="form-select block w-full mt-1">
      <option>abortion</option>
      <option>coronavirus</option>
      <option>elections-2020</option>
      <option>environment</option>
      <option>gender</option>
       <option>gun-control</option>
       <option>immigration</option>
    <option>international-politics-and-world-news</option>
    <option>middle-class</option>
    <option>sport</option>
    <option>student-debt</option>
    <option>trump-presidency</option>
    <option>vaccines</option>
    <option>white-nationalism</option>
  </select>
                    
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="type"
                    >
                        type
                    </label>   
<div class=" max-w-sm text-center flex flex-wrap ">

  <div class="flex items-center mr-4 mb-4">
    <input id="radio1" type="radio" name="type" class="hidden" checked  value="left"/>
    <label for="radio1" class="flex items-center cursor-pointer">
     <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
     left</label>
   </div>

   <div class="flex items-center mr-4 mb-4">
    <input id="radio2" type="radio" name="type" class="hidden" value="center" />
    <label for="radio2" class="flex items-center cursor-pointer">
     <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
     center</label>
   </div>
  
    <div class="flex items-center mr-4 mb-4">
    <input id="radio3" type="radio" name="type" class="hidden" value="right"/>
    <label for="radio3" class="flex items-center cursor-pointer">
     <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
     right</label>
   </div>

 </div>
                    
                </div>
                               <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="SentenceBias"
                    >
                        SentenceBias
                    </label>   
<div class=" max-w-sm text-center flex flex-wrap ">

  <div class="flex items-center mr-4 mb-4">
    <input id="radio4" type="radio" name="SentenceBias" class="hidden" checked  value="Non-biased"/>
    <label for="radio4" class="flex items-center cursor-pointer">
     <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
     Non-Biased</label>
   </div>

   <div class="flex items-center mr-4 mb-4">
    <input id="radio5" type="radio" name="SentenceBias" class="hidden" value="Biased" />
    <label for="radio5" class="flex items-center cursor-pointer">
     <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
     Biased</label>
   </div>
  

 </div>
                    
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="SentenceStatus"
                    >
                        SentenceStatus
                    </label>   
<div class=" max-w-sm text-center flex flex-wrap ">

  <div class="flex items-center mr-4 mb-4">
    <input id="radio6" type="radio" name="SentenceStatus" class="hidden" checked  value="gold"/>
    <label for="radio6" class="flex items-center cursor-pointer">
     <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
     gold</label>
   </div>

   <div class="flex items-center mr-4 mb-4">
    <input id="radio7" type="radio" name="SentenceStatus" class="hidden" value="fresh" />
    <label for="radio7" class="flex items-center cursor-pointer">
     <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
     fresh</label>
   </div>

   <div class="flex items-center mr-4 mb-4">
    <input id="radio8" type="radio" name="SentenceStatus" class="hidden" value="golden-fresh" />
    <label for="radio8" class="flex items-center cursor-pointer">
     <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
     golden-fresh</label>
   </div>
  

 </div>
                    
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="sentence"
                    >
                        enter biased words separated by whitespace
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="biased_words"
                           id="biased_words"
                           
                    >
                </div>



              

                <div class="mb-6">
                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </main>
    </section>
            </div>
        </div>
    </div>
</x-app-layout>
