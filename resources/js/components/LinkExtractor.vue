<template>
    <div class="w-full lg:w-11/12 mx-auto mb-5 overflow-auto">
        <div class="w-full float-left pr-3">
            <button class="block float-right px-2 py-1 border-2 border-gray-300 rounded-lg hover:bg-blue-100 active:bg-blue-200 outline-none active:outline-none focus:outline-none" @click="copyAllLinks">
                <i ref="copyAll" class="fas fa-copy"></i> Copy All
            </button>
            <div class="float-right mr-5 pt-2">
                <label for="match_mode" class="flex items-center cursor-pointer">
                    <div class="mr-3 text-gray-700 font-medium">
                        Exact Match
                    </div>
                    <div class="relative">
                        <input id="match_mode" v-model="match_mode" type="checkbox" class="hidden" />
                        <div class="toggle__line w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                        <div class="toggle__dot absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"></div>
                    </div>
                    <div class="ml-3 text-gray-700 font-medium">
                        Loose Match
                    </div>
                </label>
            </div>
        </div>
        <div class="w-full clearfix flex flex-col md:flex-row float-left">
            <div class="w-full md:w-1/2 flex-1 p-3">
                <span class="block pb-2">Input the text below to extract links from</span>
                <textarea
                    name="input_text"
                    id="input_text"
                    cols="30" rows="12"
                    class="w-full p-2 rounded-lg border-2 border-gray-300 outline-none"
                    v-model="input_text"
                    placeholder="Input text with links"
                ></textarea>
            </div>
            <div class="w-full md:w-1/2  flex-1 p-3 mt-8">
                <div v-if="links === null" class="w-full overflow-auto text-center">
                    There were no links identified in the text on the left.
                </div>
                <div v-else class="w-full pb-1 overflow-auto" v-for="(link, index) in links" :key="'link_' + index">
                    <a :href="formatLink(link)" :title="link" target="_blank" class="block float-left w-11/12 p-1 bg-blue-100 rounded-lg border-2 border-gray-300 truncate">
                        <span class="mx-1"><i class="fas fa-external-link-alt"></i></span>
                        {{ formatLink(link) }}
                    </a>
                    <span class="block float-right border-2 border-gray-300 px-2 py-1 rounded-lg hover:bg-blue-100 outline-none" @click="copySingleLink(index)">
                        <i :ref="'copy-icon-'+index" class="fas fa-copy"></i>
                    </span>
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
                match_mode: false,
                links: null
            };
        },
        methods: {
            identifyMatches () {
                this.links = this.input_text.match(this.match_mode ? looseMatch : exactMatch);
            },
            formatLink (link) {
                if (!link.startsWith('http')) {
                    link = 'http://' + link;
                }
                return link;
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
            copyAllLinks () {
                let str = '';
                if (this.links != null && this.links.length > 0) {
                    for(let i = 0; i < this.links.length; i++) {
                        str += this.formatLink(this.links[i]) + '\n';
                    }
                }
                this.copyString(str);
                const el = this.$refs.copyAll;
                this.switchFeedbackIcon(el);
            },
            copySingleLink (index) {
                this.copyString(this.links[index]);
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
            input_text () {
                this.identifyMatches();
            },
            match_mode () {
                this.identifyMatches();
            }
        }
    }
</script>
<style scoped>
    .toggle__dot {
        top: -.25rem;
        left: -.25rem;
        transition: all 0.3s ease-in-out;
    }

    input:checked ~ .toggle__dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
</style>
