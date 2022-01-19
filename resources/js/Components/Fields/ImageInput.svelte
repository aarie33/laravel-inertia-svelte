<script>
	let  avatar, fileinput;
	
	const onFileSelected =(e)=>{
  let image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                 avatar = e.target.result
            };
}
	
</script>
Upload Image
<div class="w-full flex flex-col border border-gray-200 p-2 rounded">
  {#if avatar}
    <img class="cursor-pointer" on:click={()=>{fileinput.click();}} src="{avatar}" alt="d" />
  {:else}
    <div class="cursor-pointer" on:click={()=>{fileinput.click();}}>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-blue-500" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
      </svg>
    </div>
  {/if}
  <div class="cursor-pointer mx-auto" on:click={()=>{fileinput.click();}}>Choose Image</div>
  <input class="hidden" type="file" accept=".jpg, .jpeg, .png" on:change={(e)=>onFileSelected(e)} bind:this={fileinput} >
</div>
