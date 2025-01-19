<!-- resources/views/components/news-alerts.blade.php -->
<div x-data="{ alerts: [] }"
     x-init="fetch('/api/news-alerts')
        .then(response => response.json())
        .then(data => alerts = data)"
     class="news-alerts-container">
    <template x-if="alerts.length > 0">
        <div class="alert-wrapper">
            <template x-for="alert in alerts" :key="alert.id">
                <div class="alert" :class="{
                    'alert-danger border-danger': alert.priority === 'high',
                    'alert-warning border-warning': alert.priority === 'medium',
                    'alert-info border-info': alert.priority === 'low'
                }">
                    <div class="d-flex">
                        <div class="alert-icon">
                            <i class="fas" :class="{
                                'fa-exclamation-circle text-danger': alert.priority === 'high',
                                'fa-exclamation-triangle text-warning': alert.priority === 'medium',
                                'fa-info-circle text-info': alert.priority === 'low'
                            }"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="alert-heading" x-text="alert.title"></h4>
                            <p class="mb-0" x-text="alert.content"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </template>
</div>

<!-- Add this CSS to your stylesheet -->
<style>
    .news-alerts-container {
        margin: 1rem 0;
    }

    .alert-wrapper {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .alert {
        margin-bottom: 0;
        border-left-width: 4px;
    }

    .alert-icon {
        display: flex;
        align-items: center;
        font-size: 1.25rem;
    }

    .alert-heading {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
</style>
