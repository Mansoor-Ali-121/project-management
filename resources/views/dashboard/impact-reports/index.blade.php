@extends('template')

@section('main-content')
    <style>
        .custom-report-container {
            padding: 20px 40px;
            width: 100%;
            box-sizing: border-box;
            min-height: calc(100vh - 140px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .custom-report-card {
            background-color: #121212;
            border: 1px solid #d4af37;
            border-radius: 14px;
            padding: 30px;
            color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .custom-report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .custom-report-title {
            color: #d4af37;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Cinzel', serif;
        }

        .custom-report-subtitle {
            color: #888;
            font-size: 13px;
            margin: 5px 0 0 0;
        }

        /* Dashboard Matching Grid & Cards Style */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background-color: #121212;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 25px 20px;
            position: relative;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            transition: 0.3s;
        }

        .stat-box:hover {
            border-color: #d4af37;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.15);
        }

        .stat-icon {
            color: #d4af37;
            font-size: 20px;
            margin-bottom: 15px;
            background: rgba(212, 175, 55, 0.1);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .stat-number {
            color: #fff;
            font-size: 28px;
            font-weight: bold;
            margin: 0 0 5px 0;
            font-family: 'Cinzel', serif;
        }

        .stat-label {
            color: #888;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
            font-weight: 600;
        }

        /* Export Button */
        .custom-export-btn {
            background-color: #d4af37;
            color: #121212;
            border: none;
            padding: 8px 18px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .custom-export-btn:hover {
            opacity: 0.9;
            color: #121212;
        }

        /* Report Section Box */
        .report-section-box {
            background-color: #161616;
            border: 1px solid #333;
            border-radius: 10px;
            padding: 25px;
            margin-top: 20px;
        }

        .report-section-box h4 {
            color: #d4af37;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
            font-family: 'Cinzel', serif;
        }

        .report-text {
            color: #aaa;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }
    </style>

    <div class="custom-report-container">
        <div class="custom-report-card">

            <!-- Header Section -->
            <div class="custom-report-header">
                <div>
                    <h2 class="custom-report-title">Impact Reports</h2>
                    <p class="custom-report-subtitle">Analyze system performance, project progress, and overall statistics.</p>
                </div>
                <button onclick="window.print();" class="custom-export-btn">
                    <i class="fas fa-download"></i> Export Report
                </button>
            </div>

            <!-- Dashboard Matching Statistics Cards Grid -->
            <div class="stats-grid">
                
                <!-- Total Projects Card -->
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <p class="stat-number">{{ $totalProjects }}</p>
                    <p class="stat-label">Total Projects</p>
                </div>

                <!-- Active Volunteers Card -->
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="stat-number">{{ $activeVolunteers }}</p>
                    <p class="stat-label">Active Volunteers</p>
                </div>

                <!-- Completed Tasks Card -->
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <p class="stat-number">{{ $completedTasks }}</p>
                    <p class="stat-label">Completed Tasks</p>
                </div>

                <!-- System Users Card -->
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <p class="stat-number">{{ $systemUsers }}</p>
                    <p class="stat-label">System Users</p>
                </div>

            </div>

            <!-- Detailed Analytics / Summary Box -->
            <div class="report-section-box">
                <h4>Performance Overview</h4>
                <p class="report-text">
                    This impact report provides a comprehensive summary of organizational activities, milestones achieved, and resource utilization directly pulled from the system database. Use the export button above to print or save a hard copy of this report for record-keeping and stakeholder reviews.
                </p>
            </div>

        </div>
    </div>
@endsection