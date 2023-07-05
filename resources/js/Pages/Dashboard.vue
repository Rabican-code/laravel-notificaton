<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { ref } from "vue";
import Swal from "sweetalert2";
const props = defineProps({
  tokens: Array,
  abc: String
});

const siteId = ref();
const title = ref();
const desc = ref();
const sendNotifications = () => {
  // alert("Write axio call to /send api here to send notifications"+siteId.value);
  axios
    .post("/send", {
      siteId: siteId.value,
      title: title.value,
      desc: desc.value,

    })
    .then(async function(response) {
      var data = response.data;
      Swal.fire(`Sent ${response.data.sent} notifications`);
    //   alert(`Sent ${response.data.sent} notifications`);
    });
};

console.log(props.tokens);
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div>
      <!-- <form @submit.prevent="sendNotifications" method="post">
        <select v-model="siteId">
          <option v-for="item in tokens" :key="item.id">{{ item.site_id }}</option>
        </select>
        <button
          type="submit"
          class="rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
        >Send</button>
      </form>-->

      <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form @submit.prevent="sendNotifications" method="post">
            <div>
              <label
                for="email"
                class="block text-sm font-medium leading-6 text-gray-900"
              >Select site id:</label>
              <select
                v-model="siteId"
                id="countries"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              >
                <option v-for="item in tokens" :key="item.id">{{ item.site_id }}</option>
              </select>
            </div>

            <div>
              <div class="flex items-center justify-between">
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title:</label>
                <div class="text-sm"></div>
              </div>
              <div class="mt-2">
                <input
                v-model="title"
                  name="title"
                  type="text"
                  autocomplete="current-password"
                  required
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
              <label
                for="desc"
                class="block text-sm font-medium leading-6 text-gray-900"
              >Description:</label>
              <div class="mt-2">
                <input
                v-model="desc"
                  name="desc"
                  type="text"
                  autocomplete="current-password"
                  required
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
              <input class="mt-2" type="file" id="myFile" name="filename" />
            </div>

            <div>
              <button
                type="submit"
                class="my-6 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
              >Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

