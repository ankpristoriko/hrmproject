<template>
    <div class="card card-with-shadow border-0 h-100 employee-preview-card">
        <div class="card-body position-relative d-flex flex-column justify-content-between">
            <div v-if="showAction" class="dropdown options-dropdown position-absolute">
                <button type="button"
                        class="btn-option btn d-flex align-items-center justify-content-center"
                        data-toggle="dropdown">
                    <app-icon name="more-horizontal"/>
                </button>
                <div class="dropdown-menu dropdown-menu-right py-2 mt-1">
                    <a class="dropdown-item px-4 py-2"
                       href="#"
                       v-for="(action,index) in actions"
                       :key="index"
                       @click.prevent="callAction(action)">
                        {{ action.title }}
                    </a>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center">
                <h5 class="mb-1 mt-3" style="font-size: 1.15rem">{{ promotion.title }}</h5>
                <!-- <div v-if="company.is_active" class="my-3">
                    <span :class="'badge badge-sm badge-pill badge-'+statusClass(company.is_active)" v-if="company.is_active == 'Y'">Published</span>
                    <span :class="'badge badge-sm badge-pill badge-'+statusClass(company.is_active)" v-else>Not Published</span>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "PromotionCard",
    props: {
        promotion: {
            type: Object,
            required: true
        },
        actions: {
            type: Array,
            required: true
        },
        showAction: {
            type: Boolean,
            default: true
        },
        id: {
            required: true
        }
    },
    methods: {
        callAction(action) {
            this.$emit('action-' + this.id, this.promotion, action, true)
        },
        statusClass(active) {
            let ClassName = 'danger';
            if (active === 'Y') ClassName = `success`;
            return ClassName;
        }
    },
}
</script>
