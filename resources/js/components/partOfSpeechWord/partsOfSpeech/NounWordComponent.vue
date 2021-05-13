<template>
    <div>
        <div v-if="nouns" v-for="(noun, index) in Object.keys(nouns)">
            <div class="py-3">{{ index + 1 }}. <b>Базовая форма</b>: {{ noun }} - Существительное ({{ listOfGrammems(nouns[noun]['Граммемы']) }})</div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Падеж</th>
                        <th scope="col">Единственное число</th>
                        <th scope="col">Множественное число</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="casePart in Object.keys(nouns[noun]['Падежи'])">
                        <th scope="row">{{ casePart }}</th>
                        <td :class="{ equals: equalsWithWord(nouns[noun]['Падежи'][casePart]['ЕД']) }">{{ nouns[noun]['Падежи'][casePart]['ЕД'] }}</td>
                        <td :class="{ equals: equalsWithWord(nouns[noun]['Падежи'][casePart]['МН']) }">{{ nouns[noun]['Падежи'][casePart]['МН'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import {globalGrammems} from "../../../mixins/grammems";

export default {
    name: "NounWordComponent",
    props: {
        nouns: {
            type: Object,
            required: true
        },
        word: {
            type: String,
            required: true
        }
    },
    methods: {
        equalsWithWord(word) {
            return this.word.toLowerCase() === word.toLowerCase();
        },
        listOfGrammems(grammems) {
            const grammemsDescription = [];

            for (let grammem of grammems) {
                grammemsDescription.push(globalGrammems[grammem.toLowerCase()])
            }

            return grammemsDescription.join(', ');
        }
    }
}
</script>

<style scoped>
    .equals {
        color: red;
    }
</style>
