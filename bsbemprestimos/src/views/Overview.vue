<template>
    <div>
        <div class="relative rounded-xl overflow-auto p-8">
            <div
                class="grid grid-cols-3 gap-x-8 gap-y-4 font-mono text-white text-sm text-center font-bold leading-6 bg-stripes-sky rounded-lg">
                <div
                    class="p-4 rounded-lg shadow-lg w-full flex justify-center h-52 items-center bg-gradient-to-r from-sky-500 to-blue-700">
                    Totais de Sensores: <h3>142</h3>
                </div>
                <div
                    class="p-4 rounded-lg shadow-lg w-full h-52 items-center flex justify-center bg-gradient-to-r from-green-700 to-green-800">
                    Totais de usuários: <h3>312</h3>
                </div>
                <div
                    class="p-4 rounded-lg shadow-lg w-full h-52 items-center flex justify-center bg-gradient-to-r from-pink-600 to-blue-800">
                    Totais de contas: <h3>33</h3>
                </div>
                <div
                    class="p-4 rounded-lg shadow-lg w-full h-52 items-center flex justify-center bg-gradient-to-r from-red-500 to-red-800">
                    Totais de empresas: <h3>20</h3>
                </div>
                <div
                    class="p-4 rounded-lg shadow-lg w-full h-52 items-center flex justify-center bg-gradient-to-r from-yellow-500 to-yellow-700">
                    Totais de LDAPs: <h3>15</h3>
                </div>
                <div
                    class="p-4 rounded-lg shadow-lg w-full h-52 items-center flex justify-center bg-gradient-to-r from-purple-500 to-purple-700">
                    Totais de erros: <h3>0</h3>
                </div>
            </div>
        </div>
</div>
</template>

<script>
export default {
    data() {
        return {

        };
    },
    methods: {

    }
}
</script>

<style scoped></style>