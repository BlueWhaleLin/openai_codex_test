<?php
$days = 100;
$hours = 1;
$minutes = 1;
$seconds = 1;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>门户网站 - 倒计时</title>
  <style>
    :root {
      color-scheme: light;
      --bg: #0f172a;
      --card: #111827;
      --accent: #38bdf8;
      --text: #e2e8f0;
      --muted: #94a3b8;
    }
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Segoe UI", "PingFang SC", "Microsoft YaHei", sans-serif;
      background: radial-gradient(circle at top, #1e293b, var(--bg));
      color: var(--text);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px;
    }
    .portal {
      width: min(960px, 100%);
      background: rgba(15, 23, 42, 0.88);
      border-radius: 24px;
      padding: 40px;
      box-shadow: 0 24px 64px rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(148, 163, 184, 0.2);
    }
    header {
      display: flex;
      flex-direction: column;
      gap: 12px;
      text-align: center;
    }
    h1 {
      margin: 0;
      font-size: clamp(28px, 4vw, 40px);
      letter-spacing: 1px;
    }
    p {
      margin: 0;
      color: var(--muted);
      font-size: 16px;
    }
    .countdown {
      margin-top: 32px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      gap: 16px;
    }
    .tile {
      background: var(--card);
      border-radius: 16px;
      padding: 24px 16px;
      text-align: center;
      border: 1px solid rgba(56, 189, 248, 0.2);
    }
    .value {
      font-size: clamp(32px, 5vw, 48px);
      font-weight: 700;
      color: var(--accent);
    }
    .label {
      margin-top: 8px;
      font-size: 14px;
      color: var(--muted);
      letter-spacing: 2px;
    }
    .actions {
      margin-top: 32px;
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      justify-content: center;
    }
    .action {
      padding: 12px 20px;
      border-radius: 999px;
      border: 1px solid rgba(148, 163, 184, 0.4);
      color: var(--text);
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .action:hover {
      border-color: var(--accent);
      color: var(--accent);
      box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.1);
    }
  </style>
</head>
<body>
  <main class="portal">
    <header>
      <h1>欢迎来到门户网站</h1>
      <p>距离重要时刻还有</p>
    </header>
    <section class="countdown" aria-live="polite">
      <div class="tile">
        <div class="value" id="days"><?php echo $days; ?></div>
        <div class="label">天</div>
      </div>
      <div class="tile">
        <div class="value" id="hours"><?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?></div>
        <div class="label">小时</div>
      </div>
      <div class="tile">
        <div class="value" id="minutes"><?php echo str_pad($minutes, 2, '0', STR_PAD_LEFT); ?></div>
        <div class="label">分钟</div>
      </div>
      <div class="tile">
        <div class="value" id="seconds"><?php echo str_pad($seconds, 2, '0', STR_PAD_LEFT); ?></div>
        <div class="label">秒</div>
      </div>
    </section>
    <section class="actions">
      <a class="action" href="#">新闻中心</a>
      <a class="action" href="#">服务大厅</a>
      <a class="action" href="#">联系我们</a>
    </section>
  </main>
  <script>
    const state = {
      totalSeconds: (<?php echo $days; ?> * 24 * 60 * 60)
        + (<?php echo $hours; ?> * 60 * 60)
        + (<?php echo $minutes; ?> * 60)
        + <?php echo $seconds; ?>,
    };

    const fields = {
      days: document.getElementById('days'),
      hours: document.getElementById('hours'),
      minutes: document.getElementById('minutes'),
      seconds: document.getElementById('seconds'),
    };

    const pad = (value) => String(value).padStart(2, '0');

    const render = () => {
      const days = Math.floor(state.totalSeconds / (24 * 60 * 60));
      const hours = Math.floor((state.totalSeconds % (24 * 60 * 60)) / (60 * 60));
      const minutes = Math.floor((state.totalSeconds % (60 * 60)) / 60);
      const seconds = state.totalSeconds % 60;

      fields.days.textContent = days;
      fields.hours.textContent = pad(hours);
      fields.minutes.textContent = pad(minutes);
      fields.seconds.textContent = pad(seconds);
    };

    const tick = () => {
      if (state.totalSeconds <= 0) {
        state.totalSeconds = 0;
        render();
        return;
      }
      state.totalSeconds -= 1;
      render();
      setTimeout(tick, 1000);
    };

    render();
    setTimeout(tick, 1000);
  </script>
</body>
</html>
