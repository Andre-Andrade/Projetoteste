<template>
    <div class="relative min-h-screen">
        <HeaderComponent />
        <main>
            <div class="container">
                <router-view
                    v-slot="{ Component }"
                    @loading:start="onLoadingStart"
                    @loading:end="onLoadingEnd"
                >
                    <LoadingSpinner v-if="$store.getters.isLoading" />
                    <transition name="fade" mode="out-in">
                        <!-- <LoadingSpinner v-if="$store.getters.isLoading" /> -->
                        <component :is="Component" />
                    </transition>
                </router-view>
                <!-- <transition name="fade" mode="out-in"> -->
                <!-- </transition> -->
            </div>
        </main>
        <FooterComponent />
    </div>
</template>

<script>
import HeaderComponent from "@/components/HeaderComponent.vue";
import FooterComponent from "@/components/FooterComponent.vue";
import LoadingSpinner from "@/components/LoadingSpinner.vue";
//import BouteilleDataService from "@/services/BouteilleDataService";

export default {
    name: "App",
    data() {
        return {
            bouteilles: [],
        };
    },
    components: {
        HeaderComponent,
        FooterComponent,
        LoadingSpinner,
    },
    methods: {
        onLoadingStart() {
            this.$store.dispatch("setLoading", true);
        },
        onLoadingEnd() {
            this.$store.dispatch("setLoading", false);
        },
        // async fetchBouteilles() {
        //     try {
        //         const response = await BouteilleDataService.getAll();
        //         this.bouteilles = response.data;
        //     } catch (error) {
        //         console.log(error.response);
        //     }
        // },
    },
    // async mounted() {
    //     await this.fetchBouteilles();
    // },
};
</script>
