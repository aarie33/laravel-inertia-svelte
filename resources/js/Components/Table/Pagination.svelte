<script>
  import { createEventDispatcher } from 'svelte';

  const dispatch = createEventDispatcher();
  export let links = [];
  export let query = {};
  export let perPageOptions = [10, 20, 50];
  export const from = 0;
  export const to = 0;
  export const total = 0;
  export let showPerPage = true;
  export let justifyCenter = false;

  function changeFilterPerPage(perPageOption) {
    dispatch("changePerPage", perPageOption); 
  }

  function visit(route) {
    if (route) {
      // this.$inertia.visit(route, {
      //   preserveScroll: true,
      //   preserveState: true,
      // });

      // TODO
      console.log('visit page');
    }
  }
</script>

<div
  class="sm:flex-1 sm:flex sm:items-center my-6"
  class:sm:justify-center={ justifyCenter }
  class:sm:justify-between={ !justifyCenter }
>
  <div>
    {#if showPerPage }
      <p class="text-sm leading-5 text-gray-600 flex">
        <span class="mr-2 my-auto">Per halaman : </span>
        {#each perPageOptions as perPageOption, index (index) }
          <span
            class="font-medium cursor-pointer mx-2 block text-center p-1 rounded-md
              {query.per_page == perPageOption ? `bg-blue-400 text-white` : ``}
              { index === 0 ? `ml-0` : ``}"
            on:click={changeFilterPerPage(perPageOption)}>
            { perPageOption }
          </span>
        {/each}
      </p>
    {/if}
  </div>
  <ul class="flex justify-center lg:justify-end">
    {#each links as link, index (index)}
      <li class="inline-block float-left ml-3 text-base">
        {#if link.label === '&laquo; Previous' || link.label === '&laquo; Sebelumnya' || link.label === 'Previous' }
          <span
            on:click={ visit(link.url) }
            class="bg-blue-400 inline-block flex items-center justify-center h-8 w-8 rounded-md cursor-pointer"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              class="w-5 h-5 text-white"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 19l-7-7 7-7"
              />
            </svg>
          </span>
        {:else if link.label === 'Next &raquo;' || link.label === 'Berikutnya &raquo;' || link.label === 'Next' }
          <span
            tabindex="0"
            class="bg-blue-400 inline-block flex items-center justify-center h-8 w-8 rounded-md cursor-pointer"
            on:click={ visit(link.url) }
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              class="w-5 h-5 text-white"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
              /></svg
          ></span>
        {:else}
          <span
            class="border border-gray-400 text-gray-500 font-bold hover:border-blue-400 hover:text-blue-400 text-md inline-block flex items-center justify-center h-8 w-8 rounded-md cursor-pointer"
            on:click={ visit(link.url) }
            class:bg-blue-150={ link.active }
            >{ link.label }</span>
          {/if}
      </li>
    {/each}
  </ul>
</div>
