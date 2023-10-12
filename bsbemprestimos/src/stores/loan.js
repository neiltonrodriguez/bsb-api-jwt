import { ref } from 'vue'
import { defineStore } from 'pinia'
import http from '../services/http.js'

export const loanStore = defineStore('loanrequest', () => {
    const loanrequest = ref({});

    function setLoanRequest(data) {
        loanrequest.value = data
    }


    return {
        loanrequest,
        setLoanRequest
    };
});