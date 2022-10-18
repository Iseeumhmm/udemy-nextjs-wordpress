{
  "key": "group_<?= strtolower($TemplateName); ?>",
  "title": "<?= $acfTitle; ?>",
  "fields": [
    
  ],
  "location": [
    [
        {
            "param": "page_template",
            "operator": "==",
            "value": "default"
        }
    ],
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
