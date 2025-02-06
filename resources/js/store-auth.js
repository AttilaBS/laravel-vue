import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useAuthStore = defineStore("auth", () => {
    const user = ref(null);

    const setUser = (newUser) => {
        user.value = newUser;
    };

    const isAuthenticated = computed(() => {
        const auth = !!user.value;
        return auth;
    });

    const clearUser = () => {
        user.value = null;
    };

    return {
        user,
        setUser,
        clearUser,
        isAuthenticated,
    };
});
