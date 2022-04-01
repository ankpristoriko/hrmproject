import {INDUSTRY_AREAS} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: INDUSTRY_AREAS,
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
                    {
                        title: this.$t('description'),
                        type: 'text',
                        key: 'description',
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
                showAction: (this.$have('PERMISSION_UPDATE_INDUSTRY_AREA') || this.$have('PERMISSION_DELETE_INDUSTRY_AREA')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-industry-area-modal',
                        modalId: 'industry-area-modal',
                        url: INDUSTRY_AREAS,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_INDUSTRY_AREA')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: INDUSTRY_AREAS,
                        modifier: () => this.$have('PERMISSION_DELETE_INDUSTRY_AREA')
                    },
                ],
            },
            isIndustryAreaAddEditModalActive: false,
            isIndustryAreaDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_INDUSTRY_AREA') || this.$have('PERMISSION_DELETE_INDUSTRY_AREA')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
