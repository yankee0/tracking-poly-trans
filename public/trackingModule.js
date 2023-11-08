document.addEventListener("DOMContentLoaded", () => {
  const { createApp, ref } = Vue;
  createApp({
    setup() {
      const search = ref("");
      const isSearch = ref(false);
      const tcs = ref([]);
      const loading = ref(false);

      const handleSubmit = async () => {
        loading.value = true;
        try {
          const response = await axios.get(url + "api/track/" + search.value);
          tcs.value = response.data

        } catch (err) {
          console.error(err);
        } finally {
          isSearch.value = true;
          loading.value = false;
        }
      };

      const handleChange = (e) => {
        e.preventDefault();
        search = e.target.value;
      };

      return {
        search,
        isSearch,
        loading,
        tcs,
        handleSubmit,
        handleChange,
      };
    },
  }).mount("#app");
});
