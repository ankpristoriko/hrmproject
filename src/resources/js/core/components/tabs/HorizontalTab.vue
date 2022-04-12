<template>
    <div class="horizontal-tab">
        <div class="card border-0">
            <nav>
                <div class="nav nav-tabs">
                    <a v-for="(tab, index) in filteredTab" :key="index"
                       class="nav-item p-primary text-capitalize"
                       :class="{'active':currentIndex == index}"
                       data-toggle="tab" :href="'#'+tab.name+'-'+index"
                       @click.prevent="loadComponent(tab,index)">
                        <span v-if="tab.icon" class="mr-2"><app-icon :name="tab.icon"/></span>{{tab.name}}
                    </a>
                </div>
            </nav>
            <!-- <div class="tab-content p-primary">
                <div class="tab-pane fade show active" :id="componentId">
                    <component :is="componentName" :props="componentProps"></component>
                </div>
            </div> -->
            <div class="card border-0">
                <div class="tab-content px-primary">
                    <div class="tab-pane fade active show" :id="componentId">
                        <div class="d-flex justify-content-between">
                            <h5 class="d-flex align-items-center text-capitalize mb-0 title tab-content-header">
                                </h5>
                            <div class="d-flex align-items-center mb-0">
                                <button v-if="!isUndefined(componentButton.label)"
                                        :class="componentButton.class?componentButton.class:'btn btn-primary'"
                                        @click.prevent="headerBtnClicked">
                                    {{componentButton.label}}
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="content py-primary">
                            <component :is="componentName" :props="componentProps" :id="componentId"></component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {TabMixin} from './mixins/TabMixin';

    export default {
        name: "HorizontalTab",
        mixins: [TabMixin],
    }
</script>
