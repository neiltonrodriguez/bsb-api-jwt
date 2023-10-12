import { ref } from 'vue'
import { defineStore } from 'pinia'
import http from './../services/http.js'

export const useAuth = defineStore('auth', () => {
    const token = ref(localStorage.getItem('token'));

    function setToken(tokenValue) {
        localStorage.setItem('token', tokenValue);
        token.value = tokenValue
    }


    function clear() {
        localStorage.removeItem('token');
        token.value = '';
    }

    async function checkToken() {
        try {
            const tokenAuth = 'Bearer ' + token.value
            const { data } = await http.post('/me', {
                headers: {
                    Authorization: tokenAuth
                }
            });
            
            return true
        } catch (error) {
            return false
            console.log(error.response.data)
        }
    }


    return {
        token,
        checkToken,
        setToken,
        clear
    }
})