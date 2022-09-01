<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import ListItem from "@/Components/Movies/ListItem.vue";
import Button from "@/Components/Button.vue";
import { computed, reactive, ref, watch } from "vue";
import FormModal from "@/Components/FormModal.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import InputError from "@/Components/InputError.vue";
import Select from "@/Components/Select.vue";
import Textarea from "@/Components/Textarea.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import Combobox from "@/Components/Combobox.vue";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
import { debounce } from "@/src/debounce";

const props = defineProps({
    movies: {
        type: Array,
        required: true,
    },
});

axios
    .get(route("api.autofill.directors"))
    .then((response) => (state.directors = response.data))
    .catch((err) => (state.directors = []));

axios
    .get(route("api.autofill.movie-ratings"))
    .then((response) => {
        state.ratings = response.data;
        form.rating = state.ratings[0];
    })
    .catch((err) => (state.ratings = []));

const state = reactive({
    modalIsOpen: false,
    ratings: [],
    directors: [],
    search: "",
});

const search = () =>
    debounce(
        () =>
            Inertia.reload({
                data: {
                    search: state.search,
                },
            }),
        250,
        "movie_search"
    );

const form = useForm({
    name: "",
    poster: null,
    released_on: "",
    rating: null,
    runtime: 0,
    plot: "",
    director_id: null,
    director_name: null,
    director_portrait: null,
    director_born_on: null,
});

const director = ref(null);

watch(director, (value) => {
    form.director_id = value?.id;
    form.director_name = value?.name;

    if (value?.id !== null) {
        form.director_portrait = null;
        form.director_born_on = null;
    }
});

const requiresDirectorFields = computed(() => {
    return director.value !== null && director.value.id === null;
});

const submitForm = () => {
    form.transform((data) => ({
        ...data,
        director_name: data.director_id === null ? data.director_name : null,
    })).post(route("movies.store"), {
        onSuccess: () => {
            director.value = null;
            state.modalIsOpen = false;
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Movies" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Movies
                </h2>
                <Button @click="state.modalIsOpen = true">Add a Movie</Button>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="search()" class="mb-2 flex">
                    <Input
                        v-model="state.search"
                        type="text"
                        placeholder="Search for a movie..."
                        class="w-full"
                        @input="search"
                    />
                </form>
                <ul role="list" class="space-y-3">
                    <list-item
                        v-for="movie in props.movies"
                        :key="movie.id"
                        :data="movie"
                    ></list-item>
                </ul>
            </div>
        </div>

        <form-modal
            title="Add a movie"
            description="Fill out a few details and we'll add the movie to our database."
            :active="state.modalIsOpen"
            @close="state.modalIsOpen = false"
        >
            <template #form>
                <form
                    @submit.prevent="submitForm()"
                    id="movie_form"
                    class="space-y-3"
                >
                    <div>
                        <Label for="movie_name">Name</Label>
                        <Input
                            type="text"
                            v-model="form.name"
                            id="movie_name"
                            class="w-full"
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div>
                        <Label for="movie_poster">Poster</Label>
                        <ImageUpload
                            v-model="form.poster"
                            id="movie_poster"
                            class="w-full"
                        />
                        <InputError :message="form.errors.poster" />
                    </div>
                    <div>
                        <Label for="movie_director_id">Director</Label>
                        <Combobox
                            v-model="director"
                            :options="state.directors"
                            id="movie_director_id"
                            class="w-full"
                        />
                        <InputError :message="form.errors.director_id" />
                        <InputError :message="form.errors.director_name" />
                    </div>
                    <div v-if="requiresDirectorFields">
                        <Label for="director_portrait"
                            >Director's portrait</Label
                        >
                        <ImageUpload
                            v-model="form.director_portrait"
                            id="director_portrait"
                            class="w-full"
                        />
                        <InputError :message="form.errors.director_portrait" />
                    </div>
                    <div v-if="requiresDirectorFields">
                        <Label for="director_date_of_birth"
                            >Director's date of birth</Label
                        >
                        <Input
                            type="date"
                            v-model="form.director_born_on"
                            id="director_date_of_birth"
                            class="w-full"
                        />
                        <InputError :message="form.errors.director_born_on" />
                        <hr class="mt-4" />
                    </div>
                    <div>
                        <Label for="movie_released_on">Released on</Label>
                        <Input
                            type="date"
                            v-model="form.released_on"
                            id="movie_released_on"
                            class="w-full"
                        />
                        <InputError :message="form.errors.released_on" />
                    </div>
                    <div class="grid gap-2 md:grid-cols-2">
                        <div>
                            <Label for="movie_rating">Rating</Label>
                            <Select
                                v-model="form.rating"
                                :options="state.ratings"
                                id="movie_rating"
                                class="w-full"
                            />
                            <InputError :message="form.errors.rating" />
                        </div>
                        <div>
                            <Label for="movie_runtime"
                                >Runtime (in minutes)</Label
                            >
                            <Input
                                type="number"
                                v-model="form.runtime"
                                id="movie_runtime"
                                class="w-full"
                            />
                            <InputError :message="form.errors.runtime" />
                        </div>
                    </div>
                    <div>
                        <Label for="movie_plot">Plot</Label>
                        <Textarea
                            v-model="form.plot"
                            id="movie_plot"
                            class="w-full"
                        />
                        <InputError :message="form.errors.plot" />
                    </div>
                </form>
            </template>
            <template #actions>
                <Button
                    :disabled="form.processing"
                    type="submit"
                    form="movie_form"
                    class="sm:ml-3"
                    >Add Movie</Button
                >
            </template>
        </form-modal>
    </BreezeAuthenticatedLayout>
</template>
