<template>
    <v-app>
        <!-- Must have the app property -->
        <v-app-bar app>
            <h1 class="text-center">The Mobile shop</h1>
        </v-app-bar>
        <v-main>
            <v-container>
                <template>
                    <v-card-title>
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Search"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="devices"
                        sort-by="os"
                        :search="search"
                        class="elevation-1"
                    >
                        <template v-slot:top>
                            <v-toolbar
                                flat
                            >
                                <v-toolbar-title>Devices</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>
                                <v-dialog
                                    v-model="dialog"
                                    max-width="500px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            color="primary"
                                            dark
                                            class="mb-2"
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                            New Item
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <v-card-title>
                                            <span class="text-h5">{{ formTitle }}</span>
                                        </v-card-title>

                                        <v-card-text>
                                            <v-container>
                                                <v-form ref="form" v-model="valid" lazy-validation>
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="editedItem.model"
                                                                label="Model"
                                                                :rules="modelRules"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="editedItem.brand"
                                                                label="Brand"
                                                                :rules="brandRules"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="editedItem.os"
                                                                label="Operating System"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="editedItem.release_date"
                                                                label="Release Date"
                                                                :rules="dateRules"
                                                            ></v-text-field>
                                                        </v-col>

                                                    </v-row>
                                                </v-form>
                                            </v-container>
                                        </v-card-text>

                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                color="blue darken-1"
                                                text
                                                @click="close"
                                            >
                                                Cancel
                                            </v-btn>
                                            <v-btn
                                                color="blue darken-1"
                                                text
                                                @click="save"
                                            >
                                                Save
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                                <v-dialog v-model="dialogDelete" max-width="500px">
                                    <v-card>
                                        <v-card-title class="text-h5">Are you sure you want to delete this item?
                                        </v-card-title>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                            <v-spacer></v-spacer>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click="editItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                @click="deleteItem(item)"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                        <template v-slot:no-data>
                            <v-btn
                                color="primary"
                                @click="initialize"
                            >
                                Reset
                            </v-btn>
                        </template>
                    </v-data-table>
                </template>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        search: '',

        // Datatable headers
        headers: [
            {
                text: 'Model',
                align: 'start',
                value: 'model',
            },
            {text: 'Brand', value: 'brand'},
            {text: 'Operating System', value: 'os'},
            {text: 'Release Date', value: 'release_date'},
            {text: 'Actions', value: 'actions'},
        ],
        devices: [],
        editedIndex: -1,

        editedItem: {
            model: '',
            brand: '',
            os: '',
            release_date: '',
        },

        defaultItem: {
            model: '',
            brand: '',
            os: '',
            release_date: '',
        },

        valid: true,
        name: '',

        //Validations
        modelRules: [
            v => !!v || 'Model is Required',
            v => (v && v.length >= 2) || 'Field must be greter than 5 characters',
        ],
        brandRules: [
            v => !!v || 'Brand is Required',
            v => (v && v.length >= 2) || 'Field must be greter than 5 characters',
        ],
        dateRules: [
            v => !!v || 'Date is required',
            v => /^\d{4}([\/-])\d{2}$/.test(v) || 'Date must be in YYYY/MM'
        ]
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    created() {
        this.initialize()
    },

    methods: {
        // first list of mobile devices for datatable
        initialize() {
            axios.get('api/device')
                .then((response) => {
                    this.devices = response.data
                });
        },

        validate() {
            this.$refs.form.validate()
        },

        reset() {
            this.$refs.form.reset()
        },

        resetValidation() {
            this.$refs.form.resetValidation()
        },

        editItem(item) {
            this.editedIndex = this.devices.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true

        },

        // delete item from datatable
        deleteItem(item) {
            this.editedIndex = this.devices.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        // Delete only if Confirmed
        deleteItemConfirm() {
            this.devices.splice(this.editedIndex, 1)
            axios.delete('api/device/' + this.editedItem.id)
                .then((response) => {
                    if (response.data.status == 200) {
                        this.$toasted.success(response.data.message)
                        this.close()
                    } else {
                        this.$toasted.error("Looks like something wrong!")
                    }
                })
            this.closeDelete()
        },

        // Close dialog boxes
        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        // Closing delete confirmation dialog box
        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            // Editing record
            if (this.editedIndex > -1) {
                if (this.$refs.form.validate()) {
                    axios.put('api/device/' + this.editedItem.id,
                        {
                            model: this.editedItem.model,
                            brand: this.editedItem.brand,
                            os: this.editedItem.os,
                            release_date: this.editedItem.release_date
                        })
                        .then((response) => {
                            if (response.data.status == 200) {
                                Object.assign(this.devices[this.editedIndex], this.editedItem)
                                this.$toasted.success(response.data.message)
                                this.close()
                            } else {
                                this.$toasted.error("Looks like something wrong!")
                            }
                        });
                }
            } else {
                // Inserting new record
                if (this.$refs.form.validate()) {
                    axios.post('api/device',
                        {
                            model: this.editedItem.model,
                            brand: this.editedItem.brand,
                            os: this.editedItem.os,
                            release_date: this.editedItem.release_date
                        })
                        .then((response) => {
                            if (response.data.status == 200) {
                                this.devices.push(this.editedItem);
                                this.$toasted.success(response.data.message)
                                this.close()
                            } else {
                                this.$toasted.error("Looks like something wrong!")
                            }
                        });
                }
            }
        },
    },
}
</script>

