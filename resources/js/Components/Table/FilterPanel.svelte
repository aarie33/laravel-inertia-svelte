<script>
  import { createEventDispatcher } from 'svelte';
  import { onMount } from 'svelte';
  import { scale } from 'svelte/transition';

  const dispatch = createEventDispatcher();

  export let filters;
  export let query;
  let show = false;
  let menu = null;
  let selected = {}
  let isFiltered = false;

  function filtered() {
    for (let i in filters) {
      let getFilter = get(query, filters[i].paramName);
      if (getFilter != null && getFilter != '') {
        selected[filters[i].paramName] = getFilter;
        return true;
      }
    }
    return false;
  }

  function checkFiltered() {
    for (let i in filters) {
      let getFilter = get(query, filters[i].paramName);
      console.log('getFilter')
      console.log(getFilter)
      if (getFilter != null) {
        isFiltered = true;
        return;
      }
    }
    isFiltered = false;
  }

  function get(object, key) {
    return object[key] ?? null;
  }

  // watch reactivity
  $: query, filtered()
  $: selected, query, checkFiltered()
  $: console.log(isFiltered)
  $: selected, console.log('selected')
  $: selected, console.log(selected)
  $: console.log(query);

  onMount(() => {
    checkFiltered()

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

  const setFilter = (paramName) => {
    let filter = {
      key: paramName,
      value: selected[paramName]
    };
    dispatch("input", filter);
	}

  function clear() {
    selected = {}
    isFiltered = false
    show=!show
    dispatch('clear')
  }
</script>

<div class="relative" bind:this={menu}>
  <div>
    <button
      on:click={() => (show = !show)}
      class="bg-white focus:border-blue-500 focus:shadow-solid flex items-center justify-center 
        h-9 w-9 rounded border border-gray-200 hover:border-blue-500"
      class:bg-blue-600={isFiltered}
      class:text-white={isFiltered}
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
      </svg>
    </button>

    {#if show}
      <div
        in:scale={{ duration: 100, start: 0.95 }}
        out:scale={{ duration: 75, start: 0.95 }}
        class="origin-top-left absolute left-0 w-48 p-2 mt-1 bg-white rounded shadow-lg border border-gray-200"
      >
        <div class="flex justify-end" hidden={!isFiltered}>
          <span class="cursor-pointer text-xs" on:click={() => clear() }>clear</span>
        </div>
        {#each filters as filter, index (index)}
          <select 
            class="w-full p-2 mb-2 rounded border border-gray-200" 
            bind:value={selected[filter.paramName]} 
            on:change={(e) => setFilter(filter.paramName) }
          >
            <option value="">{ filter.label }</option>
            {#each filter.options as option}
              <option value={`${option.name}`}>{option.value}</option>
            {/each}
          </select>
        {/each}
      </div>
    {/if}
  </div>
</div>