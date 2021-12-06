<template>
    <div class="row mb-primary"
         :class="{'align-items-center': !document.value}">
        <div class="col-lg-4">
            <document-title :identifier="type"/>
        </div>
        <div class="col-lg-4">
            <template v-if="document.value">
                <document-value :value="document.value" identifier="document_no"/>
                <div class="d-flex align-items-center">
                    <p class="mb-0">
                        {{ documentDetails }}
                    </p>
                </div>
            </template>
            <p v-else class="text-muted mb-0">{{ $t('not_added_yet') }}</p>
        </div>
        <div class="col-lg-3">
            <div class="text-right mt-3 mt-lg-0">
                <div v-if="document.value" class="btn-group btn-group-action" role="group"
                     aria-label="Default action">
                    <button class="btn"
                            data-toggle="tooltip"
                            data-placement="top"
                            :title="$t('edit')"
                            v-if="$can('update_employee_address')"
                            @click.prevent="$emit('edit', type)">
                        <app-icon name="edit"/>
                    </button>
                    <button class="btn"
                            data-toggle="tooltip"
                            data-placement="top"
                            :title="$t('delete')"
                            v-if="$can('delete_employee_address')"
                            @click.prevent="$emit('delete', type)">
                        <app-icon name="trash-2"/>
                    </button>
                </div>
                <template v-else>
                    <button class="btn btn-primary"
                            @click="$emit('add', type)"
                            v-if="$can('update_employee_address')">
                        {{ $t('add') }}
                    </button>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import DocumentValue from "./DocumentValue";
import DocumentTitle from "./DocumentTitle";

export default {
    name: "Document",
    props: {
        document: {},
        type: {}
    },
    components: {DocumentTitle, DocumentValue},
    computed: {
        documentDetails() {
            const {document_id, valid_from, valid_to, note} = this.document.value
            const documents = [document_id, valid_from, valid_to, note]
            let stringDocuments = '';
            documents.map(document => {
                stringDocuments += document ? `${document}, ` : '';
            })
            return stringDocuments.replace(/,\s*$/, "");
        }
    }
}
</script>