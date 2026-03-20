<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $document['title'] }} | AFAQ Docs</title>
    <style>
        :root {
            --bg: #f3efe7;
            --panel: rgba(255, 252, 246, 0.94);
            --panel-strong: #ffffff;
            --text: #172723;
            --muted: #5e6f69;
            --line: #d8d0c3;
            --accent: #185f53;
            --accent-soft: #dcedea;
            --shadow: 0 20px 40px rgba(17, 31, 27, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(24, 95, 83, 0.15), transparent 28%),
                linear-gradient(180deg, #f8f4ec 0%, var(--bg) 100%);
        }

        a { color: inherit; text-decoration: none; }

        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 40px 24px 72px;
        }

        .hero,
        .panel,
        .card,
        .step,
        .kpi,
        .table-card {
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .hero,
        .panel,
        .card,
        .table-card {
            background: var(--panel);
            backdrop-filter: blur(10px);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 22px;
            padding: 30px;
        }

        .eyebrow {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        h1 {
            margin: 16px 0 12px;
            font-size: clamp(2.1rem, 4vw, 3.5rem);
            line-height: 1.05;
        }

        h2 {
            margin: 0 0 10px;
            font-size: 1.55rem;
        }

        h3 {
            margin: 0 0 8px;
            font-size: 1.05rem;
        }

        p,
        li {
            color: var(--muted);
            line-height: 1.65;
        }

        .hero-actions,
        .pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .button,
        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 14px;
            border: 1px solid var(--line);
            background: var(--panel-strong);
            font-weight: 600;
        }

        .button.primary {
            border-color: var(--accent);
            background: var(--accent);
            color: #fff;
        }

        .hero-side {
            display: grid;
            gap: 14px;
            align-content: start;
        }

        .kpi {
            background: linear-gradient(180deg, #fffefc 0%, #f5efe4 100%);
            padding: 18px;
        }

        .kpi strong {
            display: block;
            font-size: 1.8rem;
            color: var(--accent);
            margin-bottom: 6px;
        }

        .section {
            margin-top: 34px;
        }

        .section-header {
            margin-bottom: 16px;
        }

        .section-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
        }

        .card,
        .table-card {
            padding: 22px;
        }

        .card ul,
        .table-card ul {
            margin: 10px 0 0;
            padding-left: 18px;
        }

        .flow {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 14px;
        }

        .step {
            background: linear-gradient(180deg, rgba(24, 95, 83, 0.12), rgba(24, 95, 83, 0.03));
            padding: 20px;
        }

        .step-number {
            display: inline-flex;
            width: 34px;
            height: 34px;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: var(--accent);
            color: #fff;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th,
        .admin-table td {
            padding: 14px 0;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: top;
        }

        .admin-table th {
            color: var(--text);
            font-size: 0.92rem;
        }

        .admin-table tr:last-child td,
        .admin-table tr:last-child th {
            border-bottom: 0;
        }

        code {
            padding: 2px 8px;
            border-radius: 999px;
            background: #eee8dc;
            font-family: Consolas, Monaco, monospace;
            font-size: 0.92em;
        }

        .footer-note {
            margin-top: 34px;
            padding: 20px 22px;
        }

        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .admin-table,
            .admin-table tbody,
            .admin-table tr,
            .admin-table th,
            .admin-table td {
                display: block;
                width: 100%;
            }

            .admin-table th {
                padding-bottom: 6px;
                border-bottom: 0;
            }

            .admin-table td {
                padding-top: 0;
            }

            .admin-table tr {
                padding: 14px 0;
                border-bottom: 1px solid var(--line);
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="hero">
            <div>
                <span class="eyebrow">CRM Guide</span>
                <h1>How the AFAQ CRM works from lead capture to follow-up.</h1>
                <p>
                    This page explains the CRM areas available in the admin panel, the core customer and staff workflows,
                    the data that powers reporting, and how leads, inquiries, bookings, forms, campaigns, and notifications
                    connect together.
                </p>
                <div class="hero-actions">
                    <a class="button primary" href="{{ url('/admin') }}">Open Admin Panel</a>
                    <a class="button" href="{{ route('docs.documents.download', 'crm-features') }}">Download Raw Notes</a>
                    <a class="button" href="{{ route('docs.index') }}">Back To Docs Hub</a>
                </div>
            </div>

            <aside class="hero-side">
                <div class="kpi">
                    <strong>4</strong>
                    <span>Dashboard widgets active by default: KPI stats, lead sources, latest inquiries, latest bookings.</span>
                </div>
                <div class="kpi">
                    <strong>8+</strong>
                    <span>CRM work areas managed in Filament: leads, customers, inquiries, bookings, campaigns, forms, notifications, and projects.</span>
                </div>
                <div class="kpi">
                    <strong>5</strong>
                    <span>Lead intake channels supported in code: website, mobile app, Facebook, Google, and manual admin entry.</span>
                </div>
            </aside>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>CRM Overview</h2>
                <p>The CRM is split between operational workspaces for staff and customer-facing APIs for intake.</p>
            </div>
            <div class="section-grid">
                <article class="card">
                    <h3>Operations</h3>
                    <p>Admins work from the Filament panel at <code>/admin</code> to review leads, manage campaigns, update inquiries, schedule bookings, and monitor activity.</p>
                </article>
                <article class="card">
                    <h3>Customer Intake</h3>
                    <p>Customer and marketing traffic enters through project browsing, lead APIs, inquiry and booking APIs, dynamic forms, and webhook integrations.</p>
                </article>
                <article class="card">
                    <h3>Reporting</h3>
                    <p>Dashboard widgets summarize lead volume, lead sources, inquiry queue health, and upcoming bookings. Campaign and visitor data support attribution reporting.</p>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>End-To-End Flow</h2>
                <p>The CRM pipeline is designed to move a prospect from acquisition into service handling and follow-up.</p>
            </div>
            <div class="flow">
                <article class="step">
                    <div class="step-number">1</div>
                    <h3>Acquire</h3>
                    <p>Visitors arrive from campaigns, referrals, or direct traffic. Marketing attribution is stored through visitor tracking and campaign UTM fields.</p>
                </article>
                <article class="step">
                    <div class="step-number">2</div>
                    <h3>Capture</h3>
                    <p>Leads can be created from website submissions, mobile app calls, Facebook webhooks, Google webhooks, or manual staff entry.</p>
                </article>
                <article class="step">
                    <div class="step-number">3</div>
                    <h3>Qualify</h3>
                    <p>Staff review lead source, campaign, customer match, notes, and timeline activity, then update status or assign the lead internally.</p>
                </article>
                <article class="step">
                    <div class="step-number">4</div>
                    <h3>Serve</h3>
                    <p>Authenticated customers can submit inquiries or bookings. Staff then work those records inside the CRM and keep statuses updated.</p>
                </article>
                <article class="step">
                    <div class="step-number">5</div>
                    <h3>Follow Up</h3>
                    <p>Notifications, booking history, lead activities, and campaign reporting help teams coordinate follow-up and track outcomes over time.</p>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Admin Workspaces</h2>
                <p>These are the core CRM areas staff will use day to day.</p>
            </div>
            <div class="table-card">
                <table class="admin-table">
                    <tbody>
                        <tr>
                            <th>Dashboard</th>
                            <td>Landing page for admins. Shows headline KPIs plus recent inquiries and bookings so teams can spot priority work quickly.</td>
                        </tr>
                        <tr>
                            <th>Leads</th>
                            <td>Central intake queue. Tracks source, status, assignee, linked customer, linked campaign, notes, metadata, and activity history.</td>
                        </tr>
                        <tr>
                            <th>Customers</th>
                            <td>Stores customer profiles and links them to user accounts, inquiries, bookings, leads, and submissions where available.</td>
                        </tr>
                        <tr>
                            <th>Inquiries</th>
                            <td>Handles inbound questions from customers with category, message, status, and admin notes.</td>
                        </tr>
                        <tr>
                            <th>Bookings</th>
                            <td>Manages appointments with date, time, status, internal notes, and a booking history timeline for auditability.</td>
                        </tr>
                        <tr>
                            <th>Campaigns</th>
                            <td>Stores marketing campaign definitions and UTM values so leads and visitors can be attributed back to acquisition channels.</td>
                        </tr>
                        <tr>
                            <th>Forms</th>
                            <td>Includes both form templates and form submissions. Teams can build reusable forms and review incoming responses in one place.</td>
                        </tr>
                        <tr>
                            <th>Notifications</th>
                            <td>Maintains customer-facing notification records that can be read from the mobile app and marked as read by the customer.</td>
                        </tr>
                        <tr>
                            <th>Projects + Settings</th>
                            <td>Projects support the public catalog and customer app. Settings provide public business info, app links, and site-level configuration.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Feature Breakdown</h2>
                <p>Each module solves a different CRM concern, but they share customers, campaigns, and reporting context.</p>
            </div>
            <div class="section-grid">
                <article class="card">
                    <h3>Lead Hub</h3>
                    <ul>
                        <li>Accepts leads from website and mobile APIs plus Facebook and Google webhooks.</li>
                        <li>Auto-matches campaigns by <code>utm_campaign</code> or campaign name.</li>
                        <li>Keeps an activity timeline for creation, updates, status changes, reassignment, and webhook sync events.</li>
                    </ul>
                </article>
                <article class="card">
                    <h3>Inquiry Management</h3>
                    <ul>
                        <li>Customers can submit inquiries through authenticated API routes.</li>
                        <li>Admins can categorize, review, update status, and leave internal notes.</li>
                        <li>Useful for general service requests that do not need an appointment yet.</li>
                    </ul>
                </article>
                <article class="card">
                    <h3>Booking Management</h3>
                    <ul>
                        <li>Stores booking date, time, status, customer notes, and admin notes.</li>
                        <li>Booking history records changes so teams can audit reschedules and status transitions.</li>
                        <li>Dashboard widgets surface upcoming bookings and latest activity.</li>
                    </ul>
                </article>
                <article class="card">
                    <h3>Dynamic Forms</h3>
                    <ul>
                        <li>Admins create form templates with custom fields, targets, and success messages.</li>
                        <li>Submissions are stored separately with lead identity fields and detailed answers.</li>
                        <li>Forms can target web, app, or both depending on the intake channel.</li>
                    </ul>
                </article>
                <article class="card">
                    <h3>Campaigns + Marketing</h3>
                    <ul>
                        <li>Campaigns track platform, UTM values, budget, and active periods.</li>
                        <li>Lead source breakdown and visitor tracking help show where opportunities are coming from.</li>
                        <li>Campaign-linked leads make source-to-conversion reporting possible.</li>
                    </ul>
                </article>
                <article class="card">
                    <h3>Notifications</h3>
                    <ul>
                        <li>Customers can read their notifications through the app API.</li>
                        <li>Read-state updates are supported so the customer inbox stays synchronized.</li>
                        <li>Useful for booking confirmations, reminders, and inquiry responses.</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Dashboard KPIs</h2>
                <p>The current dashboard is focused on operational visibility rather than executive-only reporting.</p>
            </div>
            <div class="section-grid">
                <article class="card">
                    <h3>Headline Stats</h3>
                    <ul>
                        <li>Total leads</li>
                        <li>New inquiries</li>
                        <li>Upcoming bookings</li>
                    </ul>
                </article>
                <article class="card">
                    <h3>Lead Analytics</h3>
                    <ul>
                        <li>Lead source breakdown</li>
                        <li>Campaign-aware attribution through lead source and marketing data</li>
                    </ul>
                </article>
                <article class="card">
                    <h3>Operational Queues</h3>
                    <ul>
                        <li>Latest inquiries table</li>
                        <li>Latest bookings table</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Customer-Facing APIs Behind The CRM</h2>
                <p>The CRM is fed by a set of API routes that support both customer workflows and staff visibility.</p>
            </div>
            <div class="section-grid">
                <article class="card">
                    <h3>Auth + Profile</h3>
                    <p><code>/api/v1/auth/*</code>, <code>/api/v1/my/profile</code>, and related customer endpoints establish the authenticated user context used for CRM-linked records.</p>
                </article>
                <article class="card">
                    <h3>Customer Actions</h3>
                    <p><code>/api/v1/inquiries</code> and <code>/api/v1/bookings</code> create the service records that staff later manage in the admin panel.</p>
                </article>
                <article class="card">
                    <h3>Lead Intake</h3>
                    <p><code>/api/v1/leads/mobile</code>, <code>/api/v1/leads/website</code>, and webhook endpoints bring marketing traffic directly into the lead queue.</p>
                </article>
                <article class="card">
                    <h3>Forms + Content</h3>
                    <p><code>/api/v1/forms/{slug}</code>, project endpoints, and public settings endpoints support discovery, content delivery, and structured data capture.</p>
                </article>
            </div>
        </section>

        <section class="panel footer-note">
            <p>
                For a raw text version that is easier to export or share in tickets, use the download button above.
                For endpoint-level details, pair this guide with the interactive API reference in the docs hub.
            </p>
        </section>
    </main>
</body>
</html>
