<template>
    <div>
        <div v-if="nouns" v-for="(noun, index) in Object.keys(this.nouns)">
            <span>{{ index + 1 }}. Базовая форма: {{ noun }}</span>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Падеж</th>
                        <th scope="col">Единственное число</th>
                        <th scope="col">Множественное число</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="casePart in Object.keys(nouns[noun])">
                        <th scope="row">{{ casePart }}</th>
                        <td>{{ nouns[noun][casePart]['ЕД'] }}</td>
                        <td>{{ nouns[noun][casePart]['МН'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "NounWordComponent",
    props: {
        nouns: Object
    }
}
</script>

<style scoped>

</style>
