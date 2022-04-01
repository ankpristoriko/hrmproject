import {COURSE_MATERIAL_CATEGORIES} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: COURSE_MATERIAL_CATEGORIES,
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
                showAction: (this.$have('PERMISSION_UPDATE_COURSE_MATERIAL_CATEGORY') || this.$have('PERMISSION_DELETE_COURSE_MATERIAL_CATEGORY')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-course-material-category-modal',
                        modalId: 'course-material-category-modal',
                        url: COURSE_MATERIAL_CATEGORIES,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_COURSE_MATERIAL_CATEGORY')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: COURSE_MATERIAL_CATEGORIES,
                        modifier: () => this.$have('PERMISSION_DELETE_COURSE_MATERIAL_CATEGORY')
                    },
                ],
            },
            isCourseMaterialCategoryAddEditModalActive: false,
            isCourseMaterialCategoryDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_COURSE_MATERIAL_CATEGORY') || this.$have('PERMISSION_DELETE_COURSE_MATERIAL_CATEGORY')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
