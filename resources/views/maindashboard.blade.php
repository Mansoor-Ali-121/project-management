<!DOCTYPE html>
<html lang="en">

@include('dashboard.includes.head')

<body>

    @include('dashboard.includes.sidebar')

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container">

            <!-- Executive Welcome Banner -->
            <div class="welcome-banner">
                <div>
                    <h1>Welcome Back, <span>Mansoor</span></h1>
                    <p>Managing full-stack web applications, database migrations, and client architectures.</p>
                </div>
                <div>
                    <a href="{{ route('projects.index') }}" class="btn-gold">View Projects</a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon"><i class="fas fa-project-diagram"></i></div>
                    <h3>{{ $activeProjectsCount ?? '6' }}</h3>
                    <p>Active Projects</p>
                </div>
                <div class="stat-card">
                    <div class="icon"><i class="fas fa-tasks"></i></div>
                    <h3>{{ $pendingTasksCount ?? '24' }}</h3>
                    <p>Pending Tasks</p>
                </div>
                <div class="stat-card">
                    <div class="icon"><i class="fas fa-server"></i></div>
                    <h3>100%</h3>
                    <p>Server Uptime</p>
                </div>
                <div class="stat-card">
                    <div class="icon"><i class="fas fa-database"></i></div>
                    <h3>Synced</h3>
                    <p>Database Status</p>
                </div>
            </div>

            <!-- Analytics & Revenue Section -->
            <div class="analytics-grid">

                <!-- Project Progress Analytics Card -->
                <div class="chart-card">
                    <div class="section-title">
                        <span><i class="fas fa-chart-line"></i> Development Workflow Analytics</span>
                        <span style="font-size: 0.8rem; color: var(--gold);">2026 Cycle</span>
                    </div>
                    <div class="bar-chart">
                        <div class="bar-group">
                            <div class="bar" style="height: 60%;"></div>
                            <span class="bar-label">Jan</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar" style="height: 75%;"></div>
                            <span class="bar-label">Feb</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar" style="height: 85%;"></div>
                            <span class="bar-label">Mar</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar" style="height: 70%;"></div>
                            <span class="bar-label">Apr</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar" style="height: 90%;"></div>
                            <span class="bar-label">May</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar" style="height: 95%;"></div>
                            <span class="bar-label">Jun</span>
                        </div>
                    </div>
                </div>

                <!-- System Health & Overview Card -->
                <div class="revenue-card">
                    <div class="section-title">
                        <span><i class="fas fa-server"></i> System Metrics</span>
                    </div>
                    <div class="payment-stats">
                        <div class="payment-item">
                            <span>API Endpoints</span>
                            <span class="amount" style="color: #4ade80;">OPTIMIZED</span>
                        </div>
                        <div class="payment-item">
                            <span>Pending Migrations</span>
                            <span class="amount">0 Queued</span>
                        </div>
                        <div class="payment-item">
                            <span>Environment</span>
                            <span class="amount" style="color: var(--gold);">PRODUCTION</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Actions & Recent Tasks Section -->
            <div class="extra-grid">

                <!-- Quick Management Actions -->
                <div class="action-card">
                    <div class="section-title">
                        <span><i class="fas fa-bolt"></i> Quick Actions</span>
                    </div>
                    <div class="quick-actions-grid">
                        <a href="{{ route('projects.add') }}" class="action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>New Project</span>
                        </a>
                        <a href="#" class="action-btn" onclick="event.preventDefault(); alert('Cache cleared successfully!');">
                            <i class="fas fa-sync-alt"></i>
                            <span>Clear Cache</span>
                        </a>
                        <a href="#" class="action-btn" onclick="event.preventDefault(); alert('Exporting reports...');">
                            <i class="fas fa-file-export"></i>
                            <span>Export Report</span>
                        </a>
                        <a href="#" class="action-btn" onclick="event.preventDefault(); alert('Artisan migration triggered!');">
                            <i class="fas fa-terminal"></i>
                            <span>Run Migration</span>
                        </a>
                    </div>
                </div>

                <!-- Recent Tasks / Active Repos List -->
                <div class="orders-card">
                    <div class="section-title">
                        <span><i class="fas fa-tasks"></i> Recent Tasks & Repos</span>
                        <a href="{{ route('projects.index') }}" style="font-size: 0.8rem; color: var(--gold); text-decoration: none;">View All</a>
                    </div>
                    <div class="orders-list">
                        <div class="order-item">
                            <div class="order-content">
                                <div class="order-info">
                                    <h4>Naini Restaurant Management System</h4>
                                    <p>Module: Laravel Templates & Serverless Vercel</p>
                                </div>
                                <div class="order-meta">
                                    <span class="price" style="color: #4ade80; font-size: 0.85rem;">Deployed</span>
                                    <span class="status">Completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="order-item">
                            <div class="order-content">
                                <div class="order-info">
                                    <h4>E-Commerce RESTful API Architecture</h4>
                                    <p>Module: Artisan Database Migrations</p>
                                </div>
                                <div class="order-meta">
                                    <span class="price" style="color: var(--gold); font-size: 0.85rem;">In Progress</span>
                                    <span class="status" style="color: var(--gold);">Active</span>
                                </div>
                            </div>
                        </div>
                        <div class="order-item">
                            <div class="order-content">
                                <div class="order-info">
                                    <h4>Car Sphere Theme Integration</h4>
                                    <p>Module: Custom CSS & Breakpoint Scaling</p>
                                </div>
                                <div class="order-meta">
                                    <span class="price" style="color: #4ade80; font-size: 0.85rem;">Synced</span>
                                    <span class="status">Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        @include('dashboard.includes.footer')
    </div>

</body>

</html>