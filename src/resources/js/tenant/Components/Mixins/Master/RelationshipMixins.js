import {RELATIONSHIPS} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: RELATIONSHIPS,
                showHeader: true,
                tableShadow:false,
                tablePaddingClass:'pt-primary',
                columns: [
                    {
                        title: this.$t('name'),
                        type: 'text',
                        key: 'name',
                        isVisible: true,
                    },
                ],
                filters: [
                    {
                        title: this.$t('created'),
                        type: "range-picker",
                        key: "date",
                        option: ["today", "thisMonth", "last7Days", "thisYear"]
                    },
                ],
                paginationType: "pagination",
                responsive: true,
                rowLimit: 10,
                showAction: (this.$have('PERMISSION_UPDATE_RELATIONSHIP') || this.$have('PERMISSION_DELETE_RELATIONSHIP')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-relationship-modal',
                        modalId: 'relationship-modal',
                        url: RELATIONSHIPS,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_RELATIONSHIP')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: RELATIONSHIPS,
                        modifier: () => this.$have('PERMISSION_DELETE_RELATIONSHIP')
                    },
                ],
            },
            isRelationshipAddEditModalActive: false,
            isRelationshipDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_RELATIONSHIP') || this.$have('PERMISSION_DELETE_RELATIONSHIP')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
