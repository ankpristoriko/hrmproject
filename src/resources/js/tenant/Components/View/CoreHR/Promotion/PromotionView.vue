<template>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-primary" v-if="data.length > 0"
             v-for="(promotion, rowIndex) in data" :key="'row'+rowIndex">
            <promotion-card
                :id="id"
                :promotion="promotion"
                :actions="actions"
                @action-promotion-view-table="getAction"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "PromotionView",
    props: ['id', 'data', 'actions'],
    methods: {
        getAction(row, action, active) {
            this.$emit('getCardAction', row, action, active);
        }
    }
}
</script>