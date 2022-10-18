{
  "key": "group_<?= strtolower($ComponentName); ?>",
  "title": "<?= $acfTitle; ?>",
  "fields": [
    
  ],
  "location": [
    [
      {
        "param": "widget",
        "operator": "==",
        "value": "rss"
      }
    ]
  ],
  "menu_order": 0,
  "position": "normal",
  "style": "seamless",
  "label_placement": "top",
  "instruction_placement": "label",
  "hide_on_screen": "",
  "active": true,
  "description": "",
  "modified": <?= time(); ?><?= "\n"; ?>
}
