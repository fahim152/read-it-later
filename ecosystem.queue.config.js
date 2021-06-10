module.exports = {
  apps : [
    {
      name: 'queue_worker',
      script: 'php artisan queue:work --timeout=0 --tries=1',
      instances: 2
    }
  ]
};
