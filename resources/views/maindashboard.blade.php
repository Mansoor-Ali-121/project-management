@extends('template')
@section('main-content')
    <!-- MAIN CONTENT -->
    <div class="container">

        <!-- Executive Welcome Banner -->
        <div class="welcome-banner">
            <div>
                <h1>Welcome Back, <span>{{ auth()->user()->name ?? 'Mansoor' }}</span></h1>
                <p>Managing full-stack web applications, database migrations, and client architectures.</p>
            </div>
            <div>
                <a href="{{ route('projects.show') }}" class="btn-gold">View Projects</a>
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
                    @php
                        $months = [
                            'Jan' => 1,
                            'Feb' => 2,
                            'Mar' => 3,
                            'Apr' => 4,
                            'May' => 5,
                            'Jun' => 6,
                        ];
                    @endphp

                    @foreach ($months as $label => $mNum)
                        <div class="bar-group">
                            <div class="bar"
                                style="height: {{ isset($chartHeights[$mNum]) ? $chartHeights[$mNum] : '60' }}%;"></div>
                            <span class="bar-label">{{ $label }}</span>
                        </div>
                    @endforeach
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
                        <span class="amount" style="color: #4ade80;">{{ $apiStatus ?? 'OPTIMIZED' }}</span>
                    </div>
                    <div class="payment-item">
                        <span>Database Tables</span>
                        <span class="amount" style="color: #4ade80;">CONNECTED</span>
                    </div>
                    <div class="payment-item">
                        <span>Environment</span>
                        <span class="amount" style="color: var(--gold);">{{ $environment ?? 'PRODUCTION' }}</span>
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
                <div class="quick-actions-grid" style="grid-template-columns: repeat(2, 1fr);">
                    <a href="{{ route('projects.add') }}" class="action-btn">
                        <i class="fas fa-plus-circle"></i>
                        <span>New Project</span>
                    </a>
                    <a href="{{ route('admin.clear-cache') }}" class="action-btn">
                        <i class="fas fa-sync-alt"></i>
                        <span>Clear Cache</span>
                    </a>
                    <a href="#" class="action-btn" onclick="event.preventDefault(); alert('Exporting reports...');"
                        style="grid-column: span 2; justify-self: center; width: 50%;">
                        <i class="fas fa-file-export"></i>
                        <span>Export Report</span>
                    </a>
                </div>
            </div>

            <!-- Recent Tasks / Active Repos List -->
            <div class="orders-card">
                <div class="section-title">
                    <span><i class="fas fa-tasks"></i> Recent Tasks & Repos</span>
                    <a href="{{ route('projects.show') }}"
                        style="font-size: 0.8rem; color: var(--gold); text-decoration: none;">View All</a>
                </div>
                <div class="orders-list">
                    @forelse($recentTasks ?? [] as $task)
                        <div class="order-item">
                            <div class="order-content">
                                <div class="order-info">
                                    <h4>{{ $task->title }}</h4>
                                    <p>Module: {{ $task->project->title ?? 'General Tasks' }}</p>
                                </div>
                                <div class="order-meta">
                                    <span class="price"
                                        style="color: {{ $task->status == 'completed' ? '#4ade80' : 'var(--gold)' }}; font-size: 0.85rem;">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                    <span class="status">{{ $task->deadline ?? 'Active' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
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
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection