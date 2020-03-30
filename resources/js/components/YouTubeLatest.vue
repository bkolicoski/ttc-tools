<template>
    <div class="w-full lg:w-11/12 mx-auto mb-5 overflow-auto">
        <div class="w-full clearfix flex flex-col md:flex-row float-left">
            <div class="w-full md:w-1/3 flex-1 p-3">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="channel_id">
                            YouTube Channel ID
                        </label>
                        <input v-model="form.channel_id"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               :class="errors.channel_id ? 'border-red-500' : ''"
                               id="channel_id"
                               type="text"
                               placeholder="UCSmcxKaBEGjnwMgLIZkL_OA">
                        <p v-if="errors.channel_id" class="text-red-500 text-xs italic">{{ errors.channel_id[0] }}</p>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="url">
                            Desired URL
                        </label>
                        <input
                            v-model="form.url"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            :class="errors.url ? 'border-red-500' : ''"
                            id="url"
                            placeholder="latest_video">
                        <p v-if="errors.url" class="text-red-500 text-xs italic">{{ errors.url[0] }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" @click="submitForm">
                            Create Link
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-full md:w-2/3 flex-2 p-3">
                <div v-if="links === null" class="w-full overflow-auto text-center">
                    There are currently no links to show.
                </div>
                <div v-else class="w-full pb-1 overflow-auto" v-for="(link, index) in links">
                    <a :href="link.full_url" :title="link" target="_blank" class="block float-left w-11/12 p-1 bg-blue-100 rounded-lg border-2 truncate">
                        <span class="mx-1"><i class="fas fa-external-link-alt"></i></span>
                        {{ link.full_url }}
                    </a>
                    <span class="block float-right border-2 px-2 py-1 rounded-lg hover:bg-blue-100 outline-none" @click="copySingleLink(index)">
                        <i :ref="'copy-icon-'+index" class="fas fa-copy"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    const axios = require('axios').default;
    export default {
        props: { recaptcha_key: String },
        data () {
            return {
                form: {
                    channel_id: null,
                    url: null,
                    token: null
                },
                errors: [],
                links: null
            };
        },
        methods: {
            submitForm() {
                this.links = null;
                this.errors = [];
                const instance = this;
                grecaptcha.execute(this.recaptcha_key, {action: 'create_link'}).then(function(token) {
                    instance.form.token = token;
                    axios.post('/youtube-latest', instance.form)
                    .then(response => {
                        instance.links = response.data.links;
                    })
                    .catch(error => {
                        instance.errors = error.response.data.errors;
                    })
                });
            },
            copyString (str) {
                const el = document.createElement('textarea');
                el.value = str;
                el.setAttribute('readonly', '');
                el.style.position = 'absolute';
                el.style.left = '-9999px';
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
            },
            copySingleLink (index) {
                this.copyString(this.links[index].full_url);
                const el = this.$refs['copy-icon-'+index][0];
                this.switchFeedbackIcon(el);
            },
            switchFeedbackIcon (el) {
                el.classList.remove("fa-copy");
                el.classList.add("fa-check");
                setTimeout(() => {
                    el.classList.remove("fa-check");
                    el.classList.add("fa-copy");
                }, 500);
            }
        },
        watch: {

        }
    }
</script>
<style scoped>
/*    .toggle__dot {
        top: -.25rem;
        left: -.25rem;
        transition: all 0.3s ease-in-out;
    }

    input:checked ~ .toggle__dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }*/
</style>
