<script>
  import { Link } from '@inertiajs/inertia-svelte'

  import ImageInput from '../Components/Fields/ImageInput.svelte';

  export let title;
</script>

<main class="px-40 py-10">
  <h5 class="text-blue-700 mb-3">{ title }</h5>
  <div class="my-2 bg-white rounded shadow p-4">
    <div class="grid grid-cols-2 gap-4 text-sm mb-4">
      <div class="col-span-1">
        Name
        <input type="text" class="h-9 rounded w-full px-2 mb-2" placeholder="Name" />
        Email
        <input type="email" class="h-9 rounded w-full px-2 mb-2" placeholder="Email" />
        Address
        <textarea class="w-full rounded mb-2" rows="7"></textarea>
      </div>
      <div class="col-span-1">
        Gender
        <select class="h-9 rounded w-full px-2 mb-2">
          <option value="">Gender</option>
          <option value="MALE">Male</option>
          <option value="FEMALE">Female</option>
        </select>

        <ImageInput />
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
          "
          type="button"
        >
          Kembali
        </button>
    </Link>
    </div>
  </div>
</main>
