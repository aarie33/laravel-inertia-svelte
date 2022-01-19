<script>
  export let label
  export let id
  export let required = false
  export let classes = ''
</script>

<label for={id} class="label-input {classes}">
  <slot>{ label }</slot>

  {#if required}
    <span class="text-red-500">*</span>
  {/if}
</label>

<style lang="postcss" scoped>
.label-input {
  @apply block text-xs text-gray-500;
}
</style>
