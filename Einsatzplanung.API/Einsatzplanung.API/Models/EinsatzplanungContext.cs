﻿using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;

namespace Einsatzplanung.API.Models
{
    public class EinsatzplanungContext : DbContext
    {
        public EinsatzplanungContext() : base(nameOrConnectionString: "einsatzplanungConStr") { }

        public DbSet<Azubi> Azubis { get; set; }

        public DbSet<Ausbilder> Ausbilder { get; set; }

        public DbSet<Fachausbilder> Fachausbilder { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Conventions.Remove<PluralizingTableNameConvention>();
        }
    }
}