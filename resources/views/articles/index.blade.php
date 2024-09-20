@extends('layouts/bootstrap/app')

@section('main')
    <main>
        <div class="row g-5">
            <div class="col-md-12">

                <div id="app">

                    <div v-if="loading" class="text-center">
                        <p>Loading articles...</p>
                    </div>

                    <div v-if="articles.length === 0 && !loading">
                        <p>No articles found.</p>
                    </div>

                    <article v-for="article in articles" :key="article.id" class="">
                        <small class="text-success text-opacity-50 fw-bold">@{{ article.category }}</small>
                        <h2 class="mb-2 fw-bold">@{{ article.title }}</h2>
                        <p class="">
                            <i class="small bi bi-clock text-info text-opacity-70"></i>
                            <span class="small text-muted">@{{ new Date(article.created_at).toLocaleDateString() }}</span>
                            <i class="small bi bi-person text-info text-opacity-70 ms-2"></i>
                            <span class="small text-muted text-body">@{{ article.author}}</span>
                            <span v-if="article.tags && article.tags.length">
                                <span v-for="tag in article.tags" :key="tag" class="small text-muted">
                                    <i class="small bi bi-tag text-info text-opacity-70"></i> @{{ tag }}
                                </span>
                            </span>
                        </p>

                        <hr>

                        <p>This is some additional paragraph placeholder content. It has been written to fill the available
                            space and show how a longer snippet of text affects the surrounding content.</p>
                    </article>

                    <div v-if="hasPages()" style="width:50%; margin-top: 20px;">
                        <button @click="getPreviousPage()" :disabled="!hasPreviousPage">Previous</button>
                        <button @click="getNextPage()" :disabled="!hasNextPage">Next</button>
                    </div>
                </div>

                <script>
                    const {
                        createApp,
                        ref,
                        computed
                    } = Vue;

                    createApp({
                        setup() {
                            const articles = ref([]);
                            const currentPage = ref(1);
                            const totalPages = ref(0);
                            const articlesPerPage = 15; // Set articles per page
                            const loading = ref(true); // Loading state

                            const fetchArticles = async (page = 1) => {
                                loading.value = true; // Set loading to true
                                try {
                                    const response = await axios.get(
                                        `/api/articles?page=${page}&per_page=${articlesPerPage}`);
                                    articles.value = response.data.data; // Access the 'data' property
                                    totalPages.value = response.data.meta.last_page; // Get total pages
                                } catch (error) {
                                    console.log(error);
                                } finally {
                                    loading.value = false; // Set loading to false
                                }
                            };

                            const getNextPage = () => {
                                if (currentPage.value < totalPages.value) {
                                    currentPage.value++;
                                    fetchArticles(currentPage.value);
                                }
                            };

                            const getPreviousPage = () => {
                                if (currentPage.value > 1) {
                                    currentPage.value--;
                                    fetchArticles(currentPage.value);
                                }
                            };

                            const hasPages = () => {
                                return totalPages.value > 1;
                            };

                            // Reactive properties for button states
                            const hasPreviousPage = computed(() => currentPage.value > 1);
                            const hasNextPage = computed(() => currentPage.value < totalPages.value);

                            // Initial fetch
                            fetchArticles(currentPage.value);

                            return {
                                articles,
                                loading,
                                hasPages,
                                getNextPage,
                                getPreviousPage,
                                hasPreviousPage,
                                hasNextPage,
                            };
                        }
                    }).mount('#app');
                </script>

            </div>
        </div>
    </main>
@endsection

@section('footer')
    <footer class="pt-5 my-5 text-muted border-top">
        <!-- Created by the Bootstrap team &middot; &copy; 2022 -->
    </footer>
@endsection
