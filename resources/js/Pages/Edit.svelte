<script>
  import { Link, useForm } from '@inertiajs/inertia-svelte'
  import { Inertia } from '@inertiajs/inertia'

  import ImageInput from '../Components/Fields/ImageInput.svelte';

  export let title;
  export let errors;
  export let resource;

  let form = useForm({
    name: resource.name,
    email: resource.email,
    phone: resource.phone,
    address: resource.address,
    gender: resource.gender,
    avatar: resource.avatar
  });

  function submit() {
    Inertia.post(`/users/${resource.id}`, {
      _method: 'put',
      ...$form
    });
  }
</script>

<main class="px-40 py-10">
  <h5 class="text-blue-700 mb-3">{ title }</h5>
  <div class="my-2 bg-white rounded shadow p-4">
    <div class="grid grid-cols-2 gap-4 text-sm mb-4">
      <div class="col-span-1">
        Name
        <input 
          type="text" 
          class="border border-gray-200 h-9 rounded w-full px-2" 
          bind:value={ $form.name } 
          placeholder="Name" />
        {#if errors.name}<div class="text-xs text-red-500">{errors.name}</div>{/if}

        <div class="mt-2">Email</div> 
        <input 
          type="email" 
          class="border border-gray-200 h-9 rounded w-full px-2" 
          bind:value={ $form.email } 
          placeholder="Email" />
        {#if errors.email}<div class="text-xs text-red-500">{errors.email}</div>{/if}
        
        <div class="mt-2">Phone</div>
        <input 
          type="phone" 
          class="border border-gray-200 h-9 rounded w-full px-2" 
          bind:value={ $form.phone } 
          placeholder="Phone" />
        {#if errors.phone}<div class="text-xs text-red-500">{errors.phone}</div>{/if}

        <div class="mt-2">Address</div>
        <textarea 
          bind:value={ $form.address }
          class="border border-gray-200 w-full rounded px-2 py-1" 
          rows="7"></textarea>
        {#if errors.address}<div class="text-xs text-red-500">{errors.address}</div>{/if}
      </div>
      <div class="col-span-1">
        Gender
        <select 
          bind:value={ $form.gender }
          class="border border-gray-200 h-9 rounded w-full px-2">
          <option value="">Gender</option>
          <option value="MALE">Male</option>
          <option value="FEMALE">Female</option>
        </select>
        {#if errors.gender}<div class="text-xs text-red-500">{errors.gender}</div>{/if}
        <div class="mt-2"></div>
        <ImageInput on:input={ (e) => $form.avatar = e.detail } value={resource.avatar_url} />
        {#if errors.avatar}<div class="text-xs text-red-500">{errors.avatar}</div>{/if}
      </div>
    </div>

    <div class="flex justify-end w-full">
      <Link
        href="/users">
        <button
          class="
            bg-white
            hover:bg-blue-50
            inline-block
            flex
            items-center
            h-9
            px-4
            rounded
            float-right
            cursor-pointer
            border border-gray-200
          "
          type="button"
        >
          Kembali
        </button>
      </Link>

      <button
        class="
          bg-blue-600
          hover:bg-blue-700
          inline-block
          flex
          items-center
          h-9
          px-4
          rounded
          float-right
          cursor-pointer
          ml-2
          text-white
        "
        on:click={ submit }
      >
        Submit
      </button>
    </div>
  </div>
</main>
