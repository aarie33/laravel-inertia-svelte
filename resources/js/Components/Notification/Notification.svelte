<script>
  import { page, inertia } from '@inertiajs/inertia-svelte'
  
  $: show = !!$page.props.flash.success || !!$page.props.flash.error
  $: message = $page.props.flash.success || $page.props.flash.error

  $: show, setTimeout(() => {
    show = false
  }, 3000);
</script>

{#if (show)}
  <div class="fixed bottom-0 right-0 mb-6 mr-6 bg-white shadow-lg border border-gray-200 
    rounded px-6 py-3 flex items-center transition ease-in-out delay-150 duration-300">
    {#if $page.props.flash.error }
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
      </svg>
    {:else if $page.props.flash.success }
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
      </svg>
    {/if}
    <div class="ml-4">
      { message }
    </div>
  </div>
{/if}
