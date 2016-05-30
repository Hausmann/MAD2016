using Einsatzplanungstool.WebApp.Models;
using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;

namespace Einsatzplanung.API.Models
{
    public class EinsatzplanungContext : DbContext
    {
        public EinsatzplanungContext() : base(nameOrConnectionString: "einsatzplanungConStr") { }

        public DbSet<Azubi> Azubis { get; set; }

        public DbSet<Ausbilder> Ausbilder { get; set; }

        public DbSet<Fachausbilder> Fachausbilder { get; set; }

        public DbSet<Abteilung> Abteilung { get; set; }

        public DbSet<Einsaetze> Einsatz { get; set; }

        public DbSet<Beruf> Beruf { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Conventions.Remove<PluralizingTableNameConvention>();
        }
    }
}