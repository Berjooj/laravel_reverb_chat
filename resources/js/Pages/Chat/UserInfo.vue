<template>
  <button @click="dropdownOpen = !dropdownOpen" class="ml-0 mr-2 flex space-between w-full">
    <div class="flex items-center gap-x-6 w-full pt-8 pl-4">
      <img class="h-14 w-14 rounded-full" :src=" imageUrl " alt="" />
      <div>
        <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-100">{{ $page.props.auth.user.name }}</h3>
      </div>
      <!-- Dropdown -->
      <div class="absolute mt-44 bg-white w-content shadow-lg rounded border border-gray-100"
        v-if=" dropdownOpen " @click.away="dropdownOpen = false">
        <ul>
          <p class="text-gray-400 text-sm text-left pl-2 mt-1 mb-1 mr-4 hover:cursor-default">Gerenciar conta</p>
          <hr>
          <li>
            <a href="/user/profile" class="block px-4 py-2 pl-2 text-gray-800 hover:bg-gray-200 text-left" disabled>Perfil</a>
          </li>
          <li>
            <button @click="logout()"
              class="block px-4 py-2 pl-2 text-sm hover:bg-gray-200 bg-gray-100 text-left rounded-bl rounded-br w-full">
              Log Out </button>
          </li>
        </ul>
      </div>

      <!-- Botão de dropdown -->
      <svg :class=" dropdownOpen ? 'rotate-fade' : '' " class="w-6 h-6 text-gray-100" fill="none" stroke="currentColor"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </div>
  </button>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {
  data()
  {
    return {
      imageUrl: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLr4kUQgUZDV7arWdDJfjINm6yybmUgb3NqGzq9e_BzQ&s',
      dropdownOpen: false
    };
  },
  methods: {
    logout()
    {
      router.post(route('logout'));
      setTimeout(() =>
      {
        window.location.href('/');
      }, 200);
    }
  }
};

// More people...
</script>

<style>
.rotate-fade {
  transform: rotate(180deg);
}
</style>