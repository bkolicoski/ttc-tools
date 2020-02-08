<template>
    <div class="w-11/12 mx-auto mb-5 overflow-auto">
        <div class="w-full float-left">
            <button class="block float-right px-2 py-1 border-2 rounded-lg hover:bg-blue-100"><i class="fas fa-copy"></i> Copy All</button>
        </div>
        <div class="w-full clearfix flex float-left">
            <div class="w-1/2 flex-1 p-3">
                <textarea name="input_text" id="input_text" cols="30" rows="15" class="w-full p-2 rounded-lg" v-model="input_text"></textarea>
            </div>
            <div class="w-1/2 flex-1 p-3">
                <div v-if="links === null" class="w-full pb-1 overflow-auto">
                    There were no links identified in the text on the left.
                </div>
                <div v-else class="w-full pb-1 overflow-auto" v-for="link in links">
                    <a :href="link" :title="link" target="_blank" class="block float-left w-11/12 p-1 bg-blue-100 rounded-lg border-2 truncate">
                        <span class="mx-1"><i class="fas fa-external-link-alt"></i></span>
                        {{ link }}
                    </a>
                    <span class="block float-right border-2 px-2 py-1 rounded-lg hover:bg-blue-100"><i class="fas fa-copy"></i></span>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    const looseMatch = /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g;
    const exactMatch = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,4}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g;
    export default {
        data () {
            return {
                input_text: '',
                links: null
            };
        },
        /*methods: {
            handleTextChanged () {
                console.log('it works');
            }
        },*/
        watch: {
            input_text (value) {
                this.links = value.match(looseMatch);
            }
        }
    }
</script>
