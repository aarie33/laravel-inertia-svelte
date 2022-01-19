<script>
  import { onMount } from 'svelte';
  import { scale } from 'svelte/transition';

  let show = false; // menu state
  let menu = null; // menu wrapper DOM reference

  onMount(() => {
    const handleOutsideClick = (event) => {
      if (show && !menu.contains(event.target)) {
        show = false;
      }
    };

    const handleEscape = (event) => {
      if (show && event.key === 'Escape') {
        show = false;
      }
    };

    // add events when element is added to the DOM
    document.addEventListener('click', handleOutsideClick, false);
    document.addEventListener('keyup', handleEscape, false);

    // remove events when element is removed from the DOM
    return () => {
      document.removeEventListener('click', handleOutsideClick, false);
      document.removeEventListener('keyup', handleEscape, false);
    };
  });
</script>

<div class="relative" bind:this={menu}>
  <div>
    <button
      on:click={() => (show = !show)}
      class="bg-white focus:border-blue-500 focus:shadow-solid flex items-center justify-center h-9 w-9 rounded"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
      </svg>
    </button>

    {#if show}
      <div
        in:scale={{ duration: 100, start: 0.95 }}
        out:scale={{ duration: 75, start: 0.95 }}
        class="origin-top-left absolute left-0 w-48 p-2 mt-1 bg-white rounded shadow-lg"
      >
        <div class="flex justify-end">
          <span class="cursor-pointer text-xs">clear</span>
        </div>
        <select class="w-full p-2 rounded">
          <option value="">Choose Status</option>
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
    {/if}
  </div>
</div>